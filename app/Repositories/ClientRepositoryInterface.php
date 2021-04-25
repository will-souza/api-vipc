<?php

namespace App\Repositories;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;

interface ClientRepositoryInterface
{
    public function all();

    public function find($id);

    public function create(ClientStoreRequest $request);

    public function update(ClientUpdateRequest $request, $id);

    public function delete($id);
}
