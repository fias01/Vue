<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Order</title>
  </head>
  <body>

    <div id="app">
        <h1>Edit Order</h1>
        <form method="post" action="{{ route('orders.update', $order->id) }}">
          @csrf @method('PUT')

        <hr>
        <h3>Order</h3>
        <p>
          Table Number :
          <input type="text" name="table_number" value="{{ $order->table_number }}"></p>
        <p>
          Payment :
          <select name="payment_id">
            @foreach ($payments as $payment)
              <option value="{{ $payment->id }}" {{ $order->payment_id == $payment->id ? 'selected' : ''}}> {{ $payment->name }} </option>
            @endforeach
          </select></p>

        <hr>
        <h3>Order Detail</h3>
        <p
          v-for="(order, index) in orders" {{-- order adalah alias / as dari orders --}}
          :key="index"
        >
          @{{ index + 1 }}.
          <select name="product_id[]" v-model="order.product_id">
            @foreach ($products as $product)
              <option value="{{ $product->id }}"> {{$product->name}} </option>
            @endforeach
          </select>

          <input type="number" name="quantity[]" v-model="order.quantity"> pcs:
          Rp <input type="number" name="subtotal[]" :value="subtotal(order.product_id, order.quantity, index)" readonly>

          <button type="button" @click="delDetail(index)">Delete</button>
        </p>

        <button type="button" @click="addDetail()">Add</button>

        <br>

        <h3>Total : Rp <input type="number" name="total" :value="total" readonly></h3>

        <button><b>Submit</b></button>

      </form>
    </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
  <script type="text/javascript">
    new Vue({
        el: '#app',

        data: {
            orders: [
              {product_id: 0, quantity: 1, subtotal: 0},
            ]
        },

        methods: {
            addDetail() {
               var order = {product_id: 0, quantity: 1, subtotal: 0};

               this.orders.push(order);
            },
            delDetail(index) {
                if (index > 0) {
                  this.orders.splice(index, 1);
                }
            },
            subtotal(product_id, quantity, index){
                total = this.products[product_id] * quantity;

                this.orders[index].subtotal = total;

                return total;
            },
        },

        computed:{
            products() {
              var product = [];

              product[0]= 0;

              @foreach ($products as $product)
                product[ {{ $product->id }} ] = {{ $product->price }}
              @endforeach

              return product;
            },

            total() {
                // return this.orders.map( order => order.subtotal ).reduce( (prev, next) => prev + next );
                  //yg di atas dan di bawah ini sama saja, cma beda liat
                return this.orders
                .map( order => order.subtotal )
                .reduce( (prev, next) => prev + next );
            }
        },

        created() {
            var orders = [];

            @foreach ($order->orderDetail as $index => $detail)

              orders[ {{$index}} ] = {

                  product_id: {{ $detail->product_id }},
                  quantity: {{ $detail->quantity }},
                  subtotal: {{ $detail->subtotal }},

              };

            @endforeach

            this.orders = orders;
        }

    });
  </script>
  </body>
</html>
