<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Gender;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    private $gender;
    private $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->gender = Gender::factory()->create();
        $this->client = [
            'id' => 1,
            'name' => 'William Souza',
            'cpf' => '111.111.111-99',
            'gender_id' => '1',
            'email' => 'wgui@live.com',
        ];
    }

    public function test_can_create_client()
    {
      $this->post(route('clients.store'), $this->client)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => $this->client['name'],
                    'cpf' => $this->client['cpf'],
                    'gender' => Gender::find($this->client['gender_id'])->name,
                    'email' => $this->client['email'],
                ]
            ]);
    }

    public function test_can_update_client()
    {
        Client::factory()->create();

        $this->put(route('clients.update', 1), $this->client)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => $this->client['name'],
                    'cpf' => $this->client['cpf'],
                    'gender' => Gender::find($this->client['gender_id'])->name,
                    'email' => $this->client['email'],
                ]
            ]);
    }

    public function test_can_show_client()
    {
        Client::factory()->create($this->client);

        $this->get(route('clients.show', 1))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => $this->client['name'],
                    'cpf' => $this->client['cpf'],
                    'gender' => Gender::find($this->client['gender_id'])->name,
                    'email' => $this->client['email'],
                ]
            ]);
    }

    public function test_can_list_clients()
    {
        Client::factory()->create($this->client);

        $this->get(route('clients.index'))
            ->assertStatus(200)
            ->assertJsonFragment([
                'data' => [[
                    'id' => $this->client['id'],
                    'name' => $this->client['name'],
                    'cpf' => $this->client['cpf'],
                    'gender' => Gender::find($this->client['gender_id'])->name,
                    'email' => $this->client['email'],
                ]]
            ]);
    }

    public function test_can_delete_client()
    {
        Client::factory()->create($this->client);

        $this->delete(route('clients.destroy', 1))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => $this->client['name'],
                    'cpf' => $this->client['cpf'],
                    'gender' => Gender::find($this->client['gender_id'])->name,
                    'email' => $this->client['email'],
                ]
            ]);
    }
}
