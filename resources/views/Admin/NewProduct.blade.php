@extends('layouts.master')

@section('title')
    New Product
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>New Product</h1>
            <hr>
            <form class="form-horizontal" method="post" action="{{route('AddProduct.Submit')}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label class="col-lg-3 control-label">Product Title:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" name="title" placeholder="Enter Product's Title"  value="{{ old('title') }}"  required autofocus >

                        @if ($errors->has('title'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                    <label class="col-lg-3 control-label">Product Category:</label>
                    <div class="col-lg-8">
                        <select class="form-control" name="category" title="Choose one of the following..." required>
                            @foreach($Categories as $category)
                                <option value="{{$category->category}}">{{$category->category}}</option>
                            @endforeach

                        </select>
                        @if ($errors->has('category'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                    <label class="col-lg-3 control-label">Product Description:</label>
                    <div class="col-lg-8">
                        <textarea class="form-control" rows="8" placeholder="Enter The Product Descriptions" name="description" required>{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Product Price:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="number" value="{{old('price')}}" name="price" placeholder="Enter Product Price." required min="1">
                        @if ($errors->has('price'))
                            <br>
                            <span class="help-block">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('stock') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Stock Amount:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="number" value="{{old('stock')}}" name="stock" placeholder="Stock Amount" required min="1">
                        @if ($errors->has('stock'))
                            <br>
                            <span class="help-block">
                                <strong>{{ $errors->first('stock') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('fileToUpload') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Product Image Path:</label>
                    <div class="col-md-8">
                        <input type="file" name="fileToUpload" id="fileToUpload" class="file" accept="image/jpg, image/jpeg, image/png" required>
                    @if ($errors->has('fileToUpload'))
                            <br>
                            <span class="help-block">
                                <strong>{{ $errors->first('fileToUpload') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input type="submit" class="btn btn-primary" value="Add Product">
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
