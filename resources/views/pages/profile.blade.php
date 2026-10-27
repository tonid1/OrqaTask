@extends('layouts.app')

@section('content')

<section class="container">
    <h2>Profile</h2>
    <p>Edit your info here</p>

    <div class="row">
        <div class="col-6">
            <form action="/update_user/{{ $user->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-4 form-group">
                        <label for="name">Username</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    </div>
                    <div class="col-4 form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                    </div>
                    <div class="col-2 form-group align-self-end">
                        <button class="btn-solid theme-primary" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-12">
            <h5>Used {{ $user->userFriendlyUsedSpace() }} of 3 GB available</h5>
            <div class="col-4" style="border-radius: 8px; background: lightgrey;">
                <span class="d-flex" style="border-radius: 8px; background: green; width: {{ round($user->usedSpace() / 3145728, 2) * 100 }}%; height: 10px;"></span>
            </div>
        </div>
    </div>
</section>

@endsection