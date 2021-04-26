<?php


namespace App\Repositories;


use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderRepository implements OrderRepositoryInterface
{
    public function all(): AnonymousResourceCollection
    {
        return OrderResource::collection(Order::with('products')->paginate(20));
    }

    public function find($id): OrderResource
    {
        $order = Order::with('products')->findOrFail($id);

        return new OrderResource($order);
    }

    public function create(OrderStoreRequest $request): OrderResource
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

        return new OrderResource($order);
    }

    public function update(OrderUpdateRequest $request, $id): OrderResource
    {
        $order = Order::findOrFail($id);

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

        return new OrderResource($order);
    }

    public function delete($id): OrderResource
    {
        $order = Order::findOrFail($id);

        $order->products()->detach();
        $order->delete();

        return new OrderResource($order);
    }
}
