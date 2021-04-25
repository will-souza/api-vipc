<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {

        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return $this->productRepository->all();
    }

    public function store(ProductStoreRequest $request)
    {
        return $this->productRepository->create($request);
    }

    public function show($id)
    {
        return $this->productRepository->find($id);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        return $this->productRepository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->productRepository->delete($id);
    }
}
