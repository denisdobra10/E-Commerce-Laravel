<?php
use App\Http\Controllers\OrdersController;

$orders = OrdersController::GetOrders();

?>


@extends('master')


@section('content')
<div class="orders-list">
    <div class="container">

        <form action="deleteallorders" method="POST">
            @csrf
            <input type="submit" class="btn btn-warning" value="Delete all orders from database">
        </form>

        <table cellspacing=0 cellpadding=10>
            <tr>
              <td>Id</td>
              <td>Products ids</td>
              <td>User id</td>
              <td>Status</td>
              <td>Payment method</td>
              <td>Address</td>
              <td>Amount</td>
            </tr>
    
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order['id'] }}</td>
                    <td>{{ $order['products_ids'] }}</td>
                    <td>{{ $order['user_id'] }}</td>
                    <td>{{ $order['status'] }}</td>
                    <td>{{ $order['payment_method'] }}</td>
                    <td>{{ $order['address'] }}</td>
                    <td>{{ $order['amount'] }}</td>

                    @if($order['status'] == "processed")

                    <td>
                        <form action="finishorder" method="POST">
                            @csrf
                            <input type="hidden" value="{{$order['id']}}" name="orderId" readonly  >
                            <input type="submit" class="btn btn-success" value="Finish order">
                        </form>
                    </td>
                    

                    @endif

                    <td>
                        <form action="deleteorder" method="POST">
                            @csrf
    
                            <input type="hidden" value="{{$order['id']}}" name="orderId"  readonly  >
                            <input type="submit" class="btn btn-danger" value="Delete order from database">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

    </div>
</div>
@endsection