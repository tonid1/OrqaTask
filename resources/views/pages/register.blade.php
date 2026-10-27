@extends('layouts.app')

@section('content')

<section class="container">
    <h2>Register</h2>
    <form action="/register_user" method="POST">
        @csrf
        <div class="row">
            <div class="col-3 form-group">
                <label for="name">Username</label>
                <input type="text" name="name" id="name" class="form-control" />
            </div>
            <div class="col-3 form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" />
            </div>
            <div class="col-3 form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" />
            </div>

            <div class="col-2 form-group align-self-end">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>

            @include('partials.form_errors', ['errors' => $errors])
        </div>
    </form>
</section>

@endsection