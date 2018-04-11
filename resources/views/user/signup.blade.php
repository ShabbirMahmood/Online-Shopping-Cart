@extends('layouts.master')

@section('title')
    User Sign Up
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>User Sign Up</h1>
            <br>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('user.signup') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Your Name">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter Your E-mail">
                </div>
                <div class="form-group">
                    <label for="phone">Cell Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter Your Cell Phone Number">
                </div>
                <div class="form-group">
                    <label for="phone">Address</label>
                    <textarea id ="address" class="form-control" rows="8" placeholder="Enter Your Address" name="address"></textarea>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter Your Password">
                </div>
                <button class="btn btn-primary">Sign Up</button>
            </form>
            <br>
            <p>Already have an account? <a href="{{ route('user.signin') }}"> Log In</a></p>
        </div>
    </div>
    @endsection
