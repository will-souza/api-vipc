<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Gender;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private $product;

    public function setUp(): void
    {
        parent::setUp();

        $this->product = [
            'id' => 1,
            'name' => 'Salgadinho',
            'color' => 'Amarelo',
            'size' => "30",
            'price' => "450",
        ];
    }

    public function test_can_create_product()
    {
        $this->post(route('products.store'), $this->product)
            ->assertStatus(201)
            ->assertJson([
                'data' => $this->product
            ]);
    }

    public function test_can_update_product()
    {
        Product::factory()->create();

        $this->put(route('products.update', 1), $this->product)
            ->assertStatus(200)
            ->assertJson([
                'data' => $this->product
            ]);
    }

    public function test_can_show_product()
    {
        Product::factory()->create($this->product);

        $this->get(route('products.show', 1))
            ->assertStatus(200)
            ->assertJson([
                'data' => $this->product
            ]);
    }

    public function test_can_list_products()
    {
        Product::factory()->create($this->product);

        $this->get(route('products.index'))
            ->assertStatus(200)
            ->assertJsonFragment([
                'data' => [
                    $this->product
                ]
            ]);
    }

    public function test_can_delete_product()
    {
        Product::factory()->create($this->product);

        $this->delete(route('products.destroy', 1))
            ->assertStatus(200)
            ->assertJson([
                'data' => $this->product
            ]);
    }
}
