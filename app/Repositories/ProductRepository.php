<?php


namespace App\Repositories;


use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return Product::paginate(20);
    }

    public function find($id)
    {
        return Product::find($id);
    }

    public function create(ProductStoreRequest $request)
    {
        $product = new Product();

        $product->name = $request->name;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->price = $request->price;

        $product->save();

        return response(['errors' => [],
            'data' => $product
        ], 201);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response(['errors' => ['id' => 'Invalid id or client not found'],
                'data' => []
            ], 404);
        }

        if ($request->name) $product->name = $request->name;
        if ($request->color) $product->color = $request->color;
        if ($request->size) $product->size = $request->size;
        if ($request->price) $product->price = $request->price;

        $product->save();

        return response(['errors' => [],
            'data' => $product
        ], 200);
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response(['errors' => ['id' => 'Invalid id or product not found'],
                'data' => []
            ], 404);
        }

        $product->delete();

        return response(['errors' => [],
            'data' => 'The product has been deleted'
        ], 200);
    }
}
