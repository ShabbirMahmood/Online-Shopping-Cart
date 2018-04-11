@extends('layouts.master')

@section('title')
  Online Book Shop
@endsection

@section('content')
  @if(Session::has('success'))
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div id="charge-message" class="alert alert-success">
        {{ Session::get('success') }}
      </div>
    </div>
  </div>
  @endif
  @foreach($products->chunk(3) as $productChunk)
    <div class="row">
      @foreach($productChunk as $product)
        <div class="col-sm-4 col-md-4">
          <div class="thumbnail">
            <img src="{!!  URL::to('images/uploads',array($product->imagePath)) !!}  " alt="Product" class="img-responsive">
            <div class="caption">
              <h3>{{ $product->title }}</h3>
              <p class="description">{{ $product->description }}</p>
              <p class="description"><strong>Product Code : </strong>{{ $product->code }}</p>
              <p class="description"><strong>Category: </strong>{{ $product->category }}</p>
              <p class="description"><strong>Stock: </strong>{{ $product->stock }}</p>
              <div class="clearfix">
                <div class="pull-left cost">
                  BDT {{ $product->price }}
                </div>
                <br>
                @if(Auth::check() && Auth::user()->role == "admin")
                <a href="{{ route('DeleteProduct', ['id' => $product->id]) }}" class="btn btn-success pull-left" role="button"><span class="glyphicon glyphicon-minus-sign"></span> Delete </a>
                @endif
                @if($product->stock > 0 )

                  <a href="{{ route('product.addtocart', ['id' => $product->id]) }}" class="btn btn-success pull-right" role="button"><span class="glyphicon glyphicon-plus-sign"></span> Add to Cart</a>
                @endif
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="row">
      {{ $products->links() }}
    </div>
  @endforeach
@endsection
