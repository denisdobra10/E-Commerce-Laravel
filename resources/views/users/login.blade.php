@extends('master')


@section('content')

<div class="container custom-login">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form action="login" method="POST">

              @csrf

                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
            
                <button type="submit" class="btn btn-primary">Login</button>

            </form>
        </div>
    </div>
</div>


@endsection