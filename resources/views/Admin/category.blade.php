@extends('layouts.master')

@section('title')
    New Product
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>New Product</h1>
            <hr>
            <div class="col-md-8 col-md-offset-2">
                <table class="table well">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Category</th>
                        {{--<th>Action</th>--}}
                    </tr>
                    </thead>
                    <tbody>

                    @php
                        $i=1
                    @endphp

                    @foreach($Categories as $category)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$category->category}}</td>
                            {{--<td><button class="btn btn-default">Delete</button></td>--}}
                        </tr>
                        @php
                            $i+=1;
                        @endphp
                    @endforeach

                    </tbody>
                </table>
                <div class="panel panel-default">
                    <div class="panel-heading">Add Category</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('AddCategory.submit') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label"> New Category</label>

                                <div class="col-md-6">
                                    <input id="category" type="text" class="form-control" name="category" value="{{ old('category') }}" required autofocus>

                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
