@extends('layouts.master')

@section('title')
    Product in the shopping cart
@endsection


@section('content')
    @if(Session::has('cart'))
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <ul class="list-group">
                    @foreach($products as $product)
                        <li class="list-group-item">
                            <span class="badge">{{ $product['qty'] }}</span>
                            <strong>{{ $product['item']  ['title'] }}  </strong>
                            <span class="label label-success"> {{ $product['price'] }}   </span>
                            <div class="btn-group">
                                 <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"> Action
                                      <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('product.deductByOne', ['product' => $product['item']['id']]) }}">Remove Items(One by One)</a> </li>
                                        <li><a href="{{ route('product.removeItem', ['product' => $product['item']['id']]) }}">Delete All Items</a> </li>
                                    </ul>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <strong>Total Price: {{ $totalPrice }}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <a href="{{ route('checkout') }}" class="btn btn-success" type="button">Check Out</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>There is no product in the shopping cart!</h2>
            </div>
        </div>
    @endif
@endsection