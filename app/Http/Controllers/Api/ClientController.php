<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Repositories\ClientRepository;

class ClientController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {

        $this->clientRepository = $clientRepository;
    }

    public function index()
    {
        return $this->clientRepository->all();
    }

    public function store(ClientStoreRequest $request)
    {
        return $this->clientRepository->create($request);
    }

    public function show($id)
    {
        return $this->clientRepository->find($id);
    }

    public function update(ClientUpdateRequest $request, $id)
    {
        return $this->clientRepository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->clientRepository->delete($id);
    }
}
