<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Detail</title>
  </head>
  <body>

    <h2>Detail Order</h2>
    <p>Table Number : {{ $order->table_number }}</p>
    <p>Payment  : {{ $order->payment->name }}</p>
    <p>User : {{ $order->user->name }}</p>

    <hr>

    <h3>Orders Details</h3>

    @foreach ($order->orderDetail as $detail)
      <p>
        {{ $detail->product->name }}
        {{ $detail->quantity }} pcs:
        {{ $detail->subtotal }}
      </p>
    @endforeach

    <h3>Total : {{ $order->total }}</h3>
  </body>
</html>
