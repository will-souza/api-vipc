<?php


namespace App\Repositories;


use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface
{
    public function all(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ClientResource::collection(Client::paginate(20));
    }

    public function find($id): ClientResource
    {
        $client = Client::findOrFail($id);

        return new ClientResource($client);
    }

    public function create(ClientStoreRequest $request): ClientResource
    {
        $client = new Client();

        $client->name = $request->name;
        $client->cpf = $request->cpf;
        $client->gender_id = $request->gender_id;
        $client->email = $request->email;

        $client->save();

        return new ClientResource($client);
    }

    public function update(ClientUpdateRequest $request, $id): ClientResource
    {
        $client = Client::findOrFail($id);

        if ($request->name) $client->name = $request->name;
        if ($request->cpf) $client->cpf = $request->cpf;
        if ($request->gender_id) $client->gender_id = $request->gender_id;
        if ($request->email) $client->email = $request->email;

        $client->save();

        return new ClientResource($client);
    }

    public function delete($id): ClientResource
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return new ClientResource($client);
    }
}
