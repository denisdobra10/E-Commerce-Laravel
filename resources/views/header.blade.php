<?php 
use App\Http\Controllers\ProductController;
$cartProductsNo = ProductController::CartItems();
?>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Denis-Store</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="createproduct">Create product</a>
          </li>



          <li class="nav-item">
            <a class="nav-link" href="logout">Log out</a>
          </li>

        </ul>
        
        <ul class="nav navbar-nav navbar-right">
          @if(session()->has('user'))
          <div class="dropdown p-4">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{session()->get('user')['username']}}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/logout">Log out</a></li>
            </ul>
          </div>

          <div class="cartInfo p-4">
            <li><a href="showcart">Cart({{$cartProductsNo}})</a></li>
          </div>

          @else
          
          <li class="nav-item p-4">
            <a class="nav-link" href="login">Login</a>
          </li>

          <li class="nav-item p-4">
            <a class="nav-link" href="register">Sign up</a>
          </li>

          @endif
        </ul>

      </div>
    </div>
  </nav>