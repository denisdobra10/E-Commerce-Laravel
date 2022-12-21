<?php 

$totalCartPrice = 0;

foreach($products as $item)
{
    $totalCartPrice += $item->price;
}

?>

@extends('master')

@section('content')
    
<div class="cart-list">
    <div class="container">

        <table cellspacing=0 cellpadding=10>
            <tr>
              <td>Title</td>
              <td>Image</td>
              <td>Price</td>
            </tr>
    
            @foreach ($products as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td><img src="/images/{{$item->gallery}}" width="200" height="200"></td>
                    <td>{{ $item->price }}</td>
                    <td><a href="cart-delete-item/{{$item->cart_id}}" class="btn btn-primary">Delete from cart</a></td>

                </tr>
            @endforeach
        </table>

        <h5>Pret total: {{$totalCartPrice}}</h5>

        <br><br>

        <a href="order" class="btn btn-primary">ORDER NOW</a>

    </div>
</div>

@endsection