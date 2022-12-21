<?php 
use App\Http\Controllers\ProductController;

$targetedProduct = ProductController::GetProductInfo($productId);
?>

@extends('master')

@section('content')
    

<div class="container custom-login">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form action="edit-product" method="POST">

              @csrf



              <div class="mb-3">
                <input type="hidden" class="form-control" id="id" name="id" value="{{$targetedProduct['id']}}" readonly>
                </div>

              <div class="mb-3">
                <label for="name" class="form-label">Titlu</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$targetedProduct['name']}}">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Pret</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{$targetedProduct['price']}}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descriere</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{$targetedProduct['description']}}">
                </div>


            
                <button type="submit" class="btn btn-primary">Actualizeaza</button>

            </form>
        </div>
    </div>

    <a href="/" class="btn btn-primary">Back</a>
</div>


@endsection