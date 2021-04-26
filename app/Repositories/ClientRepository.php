<?php


namespace App\Repositories;


use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface
{
    public function all()
    {
        return Client::paginate(20);
    }

    public function find($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response(['errors' => ['id' => 'Client not found'],
                'data' => []
            ], 404);
        }

        return $client;
    }

    public function create(ClientStoreRequest $request)
    {
        $client = new Client();

        $client->name = $request->name;
        $client->cpf = $request->cpf;
        $client->gender_id = $request->gender_id;
        $client->email = $request->email;

        $client->save();

        return response(['errors' => [],
            'data' => $client
        ], 201);
    }

    public function update(ClientUpdateRequest $request, $id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response(['errors' => ['id' => 'Invalid id or client not found'],
                'data' => []
            ], 404);
        }

        if ($request->name) $client->name = $request->name;
        if ($request->cpf) $client->cpf = $request->cpf;
        if ($request->gender_id) $client->gender_id = $request->gender_id;
        if ($request->email) $client->email = $request->email;

        $client->save();

        return response(['errors' => [],
            'data' => $client
        ], 200);
    }

    public function delete($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response(['errors' => ['id' => 'Invalid id or client not found'],
                'data' => []
            ], 404);
        }

        $client->delete();

        return response(['errors' => [],
            'data' => 'The client has been deleted'
        ], 200);
    }
}
