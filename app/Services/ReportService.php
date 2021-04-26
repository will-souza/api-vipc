<?php


namespace App\Services;


use App\Models\Order;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;

class ReportService
{
    public function create($id, $returnType)
    {
        $order = Order::findOrFail($id);
        $client = $order->client;
        $products = $order->products;

        $seller = new Party([
            'name' => 'William Souza',
            'phone' => '(11) 96497-7741',
            'custom_fields' => [
                'email' => 'wgui@live.com',
                'CPF' => '111.111.111-99',
            ],
        ]);

        $customer = new Buyer([
            'name' => $client->name,
            'custom_fields' => [
                'email' => $client->email,
                'CPF' => $client->cpf,
            ],
        ]);

        $items = [];

        foreach ($products as $product) {
            $items[] = (new InvoiceItem())
                ->title($product->name)
                ->pricePerUnit($product->price / 100)
                ->quantity($product->pivot->quantity);
        }

        $invoice = Invoice::make()
            ->seller($seller)
            ->buyer($customer)
            ->dateFormat('d/m/Y')
            ->currencySymbol('R$')
            ->currencyCode('BRL')
            ->currencyFormat('{SYMBOL} {VALUE}')
            ->currencyDecimalPoint(',')
            ->shipping(15.99)
            ->logo(public_path('images/logo_vipcommerce.png'))
            ->addItems($items);

        switch ($returnType) {
            case 'download':
                return $invoice->download();
                break;
            case 'stream':
                return $invoice->stream();
                break;
        }

        return $invoice->stream();

    }
}
