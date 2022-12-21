@extends('master')

@section('content')


<div class="container custom-login">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form action="createproduct" method="POST" enctype="multipart/form-data">

              @csrf

                <div class="mb-3">
                  <label for="name" class="form-label">Title</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                  <label for="price" class="form-label">Price</label>
                  <input type="number" class="form-control" id="price" name="price" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Long Description</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                </div>
            
                <div>
                    <label for="gallery">Image: </label>
                    <input type="file" name="gallery" accept=".jpg, .jpeg, .png" value="" required>
                </div>

                <button type="submit" class="btn btn-primary">Create new product</button>

            </form>
        </div>
    </div>
</div>

@endsection
