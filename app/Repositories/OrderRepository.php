<?php


namespace App\Repositories;


use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use App\Models\OrderProduct;

class OrderRepository implements OrderRepositoryInterface
{
    public function all()
    {
        return Order::with('products')->paginate(20);
    }

    public function find($id)
    {
        $order = Order::with('products')->find($id);

        if (!$order) {
            return response(['errors' => ['id' => 'Order not found'],
                'data' => []
            ], 404);
        }

        return $order;
    }

    public function create(OrderStoreRequest $request)
    {
        $order = new Order();

        if ($request->observation) $order->observation = $request->observation;
        $order->client_id = $request->client_id;
        $order->payment_method_id = $request->payment_method_id;

        $order->save();

        $orderProducts = [];
        foreach ($request->products as $product) {
            $orderProducts[] = [
                'order_id' => $order->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity']
            ];
        }

        OrderProduct::insert($orderProducts);

        return response(['errors' => [],
            'data' => $order
        ], 201);
    }

    public function update(OrderUpdateRequest $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response(['errors' => ['id' => 'Invalid id or order not found'],
                'data' => []
            ], 404);
        }

        if ($request->observation) $order->observation = $request->observation;
        if ($request->client_id) $order->client_id = $request->client_id;
        if ($request->payment_method_id) $order->payment_method_id = $request->payment_method_id;

        if ($request->products) {
            $order->products()->detach();

            $orderProducts = [];
            foreach ($request->products as $product) {
                $orderProducts[] = [
                    'order_id' => $order->id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity']
                ];
            }

            OrderProduct::insert($orderProducts);
        }

        $order->save();

        return response(['errors' => [],
            'data' => $order
        ], 200);
    }

    public function delete($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response(['errors' => ['id' => 'Invalid id or order not found'],
                'data' => []
            ], 404);
        }

        $order->products()->detach();
        $order->delete();

        return response(['errors' => [],
            'data' => 'The order has been deleted'
        ], 200);
    }
}
