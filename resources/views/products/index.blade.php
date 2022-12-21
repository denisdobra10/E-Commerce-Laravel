@extends('master')

@section('content')

<div class="products-list">
    <div class="container">

        <table cellspacing=0 cellpadding=10>
            <tr>
              <td>Title</td>
              <td>Image</td>
              <td>Price</td>
            </tr>
    
            @foreach ($products as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td><img src="/images/{{$item['gallery']}}" width="200" height="200"></td>
                    <td>{{ $item['price'] }}</td>
                    <td><a href="details/{{$item['id']}}" class="btn btn-primary m-5">Open product</a></td>

                    @if(session()->has('user') && session()->get('user')['username'] == "administrator")
                        <td><a href="delete-product/{{$item['id']}}" class="btn btn-primary m-5">DELETE</a></td>
                        <td><a href="edit/{{$item['id']}}" class="btn btn-primary m-5">EDIT</a></td>
                    @endif

                </tr>
            @endforeach
        </table>

    </div>
</div>
@endsection