<?php
use App\Http\Controllers\ProductController;

$cartItems = ProductController::GetCartProducts();
$itemsNo = sizeof($cartItems);

// Resolve the price
$transportFee = 15;
$subtotal = 0;

foreach($cartItems as $item)
{
    $subtotal += $item->price;
}

$finalPrice = $subtotal + $transportFee;
//


?>


@extends('master')


@section('content')
    

<div class="container custom-login">
    <div class="row">
        <div class="col-md-4 offset-md-4">

            <table>
                <thead>
                    <th>Order details</th>
                </thead>

                <tbody>

                    <tr>
                        <td>Number of items: {{$itemsNo}}</td>
                    </tr>

                    <tr>
                        <td> </td>
                    </tr>

                    <tr>
                        <td> </td>
                    </tr>
                    <tr>
                        <td> </td>
                    </tr>


                    <tr>
                        <td>Subtotal: {{$subtotal}}</td>
                    </tr>

                    <tr>
                        <td>Transport fee: {{$transportFee}}</td>
                    </tr>

                    <tr>
                        <td>Final price:: {{$finalPrice}}</td>
                    </tr>
                </tbody>
            </table>

            <br><br>

            <form action="placeorder" method="POST">

              @csrf

              <div class="mb-3">
                <label for="address" class="form-label">Shipping Address</label>
                <input type="text" class="form-control" id="address" name="address" value="Example Address no. 445" required>
              </div>

              <div class="mb-3">
                <label for="payment" class="form-label">Payment method</label>

                  <select class="form-control" id="payment" name="payment">
                    <option>Cash</option> 
                    <option>Card</option> 
                  </select>
              </div>
            
                <button type="submit" class="btn btn-primary">Submit order</button>

            </form>
        </div>
    </div>

@endsection