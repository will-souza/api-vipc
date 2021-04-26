<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Gender;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
use App\Models\Product;
use Database\Factories\ClientFactory;
use Database\Factories\OrderProductFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(PaymentMethodSeeder::class);
//        $this->call(GenderSeeder::class);

        Gender::factory(2)->create();
        Client::factory()->create();
        Product::factory(10)->create();
        PaymentMethod::factory(3)->create();
        Order::factory(5)->create();
        OrderProduct::factory(20)->create();
    }
}
