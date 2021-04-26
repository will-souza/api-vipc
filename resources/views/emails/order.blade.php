<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8" />
</head>
<body>
<h2>Pedido criado com sucesso!</h2>
<p>Olá, {{ $data['client']->name }}, seu pedido foi criado com sucesso!</p>
@if ($data['order']->observation)
    <p>Observação: {{ $data['order']->observation }}</p>
@endif
<p>Forma de pagamento: {{ $data['order']->payment_method }}</p>
<table>
    <thead>
    <tr>
        <th>Produto</th>
        <th>Valor</th>
        <th>Quantidade</th>
        <th>Subtotal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data['products'] as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>R$ {{ $product->price / 100 }}</td>
            <td>{{ $product->pivot->quantity }}</td>
            <td>R$ {{ $product->pivot->quantity * $product->price / 100 }}</td>
        </tr>
    @endforeach
        <tr>
            <td>Frete</td>
            <td>R$ 15.99</td>
            <td>1</td>
            <td>R$ 15.99</td>
        </tr>
        <tr>
            <td colspan="3">Total</td>
            <td>R$ {{ ($data['order']->total / 100) + 15.99 }}</td>
        </tr>
    </tbody>
</table>
</body>
</html>
