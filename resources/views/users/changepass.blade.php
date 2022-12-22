@extends('master')



@section('content')
    
<div class="container custom-login">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form action="changepassword" method="POST">

              @csrf

                <div class="mb-3">
                  <label for="oldpass" class="form-label">Old password</label>
                  <input type="password" class="form-control" id="oldpass" name="oldpass" required>
                </div>

                <br><br>

                <div class="mb-3">
                    <label for="newpass" class="form-label">New password</label>
                    <input type="password" class="form-control" id="newpass" name="newpass" required>
                </div>

                <div class="mb-3">
                    <label for="repeatnewpass" class="form-label">Repeat new password</label>
                    <input type="password" class="form-control" id="repeatnewpass" name="repeatnewpass" required>
                </div>  


                <button type="submit" class="btn btn-primary">Change your password</button>

            </form>
        </div>
    </div>
</div>

@endsection