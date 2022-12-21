@extends('master')


@section('content')
    
<div class="container text-center">
    <div class="row">
        <div class="col-sm6">
            <img src="/images/{{$product['gallery']}}" width="400" height="400">
        </div>

        <div class="col-sm6">
            <div class="name">
                <h1>{{$product['name']}}</h3>
            </div>

            <div class="price">
                <h5>{{$product['price']}}</h1>
            </div>

            <div class="description">
                <p>{{$product['description']}}</p>
            </div>
        </div>

        <div class="addtocart">
            <form action="/add-to-cart" method="POST">
                @csrf

                <input type="hidden" name="product_id" value="{{$product['id']}}" readonly>
                <button type="submit" class="btn btn-primary m-1">Add to cart</button>
            </form>
        </div>

        <div class="addtocart">
            <a href="add-to-cart/{{$product['id']}}" class="btn btn-success mb-5">BUY NOW</a>
        </div>

    </div>

    <a href="/" class="btn btn-primary">Back</a>
</div>

@endsection