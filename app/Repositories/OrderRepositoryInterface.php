<?php

namespace App\Repositories;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;

interface OrderRepositoryInterface
{
    public function all();

    public function find($id);

    public function create(OrderStoreRequest $request);

    public function update(OrderUpdateRequest $request, $id);

    public function delete($id);
}
