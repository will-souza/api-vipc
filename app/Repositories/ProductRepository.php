<?php


namespace App\Repositories;


use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return ProductResource::collection(Product::paginate(20));
    }

    public function find($id)
    {
        $product = Product::findOrFail($id);

        return new ProductResource($product);
    }

    public function create(ProductStoreRequest $request)
    {
        $product = new Product();

        $product->name = $request->name;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->price = $request->price;

        $product->save();

        return new ProductResource($product);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->name) $product->name = $request->name;
        if ($request->color) $product->color = $request->color;
        if ($request->size) $product->size = $request->size;
        if ($request->price) $product->price = $request->price;

        $product->save();

        return new ProductResource($product);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return new ProductResource($product);
    }
}
