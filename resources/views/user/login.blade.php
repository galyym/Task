@extends('main.layout')

@section('page-title')
    Login
@endsection

@section('content')
    <form class="w-50 mx-auto" action={{ route('login') }} method="post">
        @csrf
        <div class="form-group mb-3 mx-auto">
            <h1>Login</h1>
        </div>
        <div class="form-group mb-2">
            <label>Email address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email">
        </div>
        <div class="form-group mb-2">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
