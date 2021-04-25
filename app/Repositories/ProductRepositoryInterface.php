<?php

namespace App\Repositories;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

interface ProductRepositoryInterface
{
    public function all();

    public function find($id);

    public function create(ProductStoreRequest $request);

    public function update(ProductUpdateRequest $request, $id);

    public function delete($id);
}
