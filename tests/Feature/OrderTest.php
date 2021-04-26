<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Gender;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    private $gender;
    private $client;
    private $paymentMethod;
    private $product;
    private $order;

    public function setUp(): void
    {
        parent::setUp();

        $this->gender = Gender::factory(2)->create();
        $this->client = Client::factory(1)->create();
        $this->paymentMethod = PaymentMethod::factory(3)->create();
        $this->product = Product::factory()->create();
        $this->order = [
            'observation' => 'Pagamento na entrega',
            'client_id' => '1',
            'payment_method_id' => '1',
            'products' => [
                [
                    'product_id' => 1,
                    'quantity' => 3
                ],
            ],
        ];
    }

    public function test_can_create_order()
    {
        $this->post(route('orders.store'), $this->order)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'observation' => $this->order['observation'],
                    'payment_method' => PaymentMethod::find($this->order['payment_method_id'])->name,
                    'client_id' => $this->order['client_id'],
                    'products' => [
                        [
                            'id' => $this->order['products'][0]['product_id'],
                            'name' => $this->product['name'],
                            'color' => $this->product['color'],
                            'size' => $this->product['size'],
                            'price' => $this->product['price'],
                            'quantity' => $this->order['products'][0]['quantity'],
                        ]
                    ],
                    'total' => $this->product['price'] * $this->order['products'][0]['quantity']
                ]
            ]);
    }

    public function test_can_update_order()
    {
        Order::factory()->create();

        $this->put(route('orders.update', 1), $this->order)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'observation' => $this->order['observation'],
                    'payment_method' => PaymentMethod::find($this->order['payment_method_id'])->name,
                    'client_id' => $this->order['client_id'],
                    'products' => [
                        [
                            'id' => $this->order['products'][0]['product_id'],
                            'name' => $this->product['name'],
                            'color' => $this->product['color'],
                            'size' => $this->product['size'],
                            'price' => $this->product['price'],
                            'quantity' => $this->order['products'][0]['quantity'],
                        ]
                    ],
                    'total' => $this->product['price'] * $this->order['products'][0]['quantity']
                ]
            ]);
    }

    public function test_can_show_order()
    {
        $this->post(route('orders.store'), $this->order);

        $this->get(route('orders.show', 1))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => 1,
                    'observation' => $this->order['observation'],
                    'payment_method' => PaymentMethod::find($this->order['payment_method_id'])->name,
                    'client_id' => $this->order['client_id'],
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'products' => [
                        [
                            'id' => $this->order['products'][0]['product_id'],
                            'name' => $this->product['name'],
                            'color' => $this->product['color'],
                            'size' => (string) $this->product['size'],
                            'price' => (string) $this->product['price'],
                            'quantity' => (string) $this->order['products'][0]['quantity'],
                        ]
                    ],
                    'total' => (string) ($this->product['price'] * $this->order['products'][0]['quantity'])
                ]
            ]);
    }

    public function test_can_list_orders()
    {
        $this->post(route('orders.store'), $this->order);

        $this->get(route('orders.index'))
            ->assertStatus(200)
            ->assertJsonFragment([
                'data' => [
                    [
                        'id' => 1,
                        'observation' => $this->order['observation'],
                        'payment_method' => PaymentMethod::find($this->order['payment_method_id'])->name,
                        'client_id' => $this->order['client_id'],
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'products' => [
                            [
                                'id' => $this->order['products'][0]['product_id'],
                                'name' => $this->product['name'],
                                'color' => $this->product['color'],
                                'size' => (string) $this->product['size'],
                                'price' => (string) $this->product['price'],
                                'quantity' => (string) $this->order['products'][0]['quantity'],
                            ]
                        ],
                        'total' => (string) ($this->product['price'] * $this->order['products'][0]['quantity'])
                    ]
                ]
            ]);
    }

    public function test_can_delete_order()
    {
        $this->post(route('orders.store'), $this->order);

        $this->delete(route('orders.destroy', 1))
            ->assertStatus(200)
            ->assertJsonFragment([
                'data' => [
                    'id' => 1,
                    'observation' => $this->order['observation'],
                    'payment_method' => PaymentMethod::find($this->order['payment_method_id'])->name,
                    'client_id' => $this->order['client_id'],
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'products' => [],
                    'total' => 0
                ]
            ]);
    }

    public function test_can_show_report()
    {
        Order::factory()->create();
        Product::factory()->create();
        OrderProduct::factory(5)->create();

        $this->post(route('orders.report', 1))
        ->assertStatus(200);
    }

    public function test_can_send_email()
    {
        Order::factory()->create();
        Product::factory()->create();
        OrderProduct::factory(5)->create();

        $this->post(route('orders.sendmail', 1))
            ->assertJson([
                'data' => 'Email successfully sent'
            ]);
    }
}
