<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Order Page</title>
  </head>
  <body>

    <h3>Order List</h3>

    <a href="{{ route('orders.create') }}">New Order</a>

    <table>
      <thead>
        <tr>
          <th>Table Number</th>
          <th>Payment</th>
          <th>Total</th>
          <th>User</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($orders as $order)
          <tr>
            <td>{{ $order->table_number }}</td>
            <td>{{ $order->payment->name }}</td>
            <td>{{ $order->total }}</td>
            <td>{{ $order->user->name }}</td>
            <td>
              <a href="{{ route('orders.show', $order->id) }}">Detail</a>
            </td>
          </tr>
        @endforeach
      </tbody>

    </table>

  </body>
</html>
