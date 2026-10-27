@extends('layouts.app')

@section('content')

<section class="container">
    <h2>Users</h2>

    <div class="row py-8">
        <table class="table">
            <thead>
                <tr class="theme-inverse">
                    <th scope="col"></th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Used space</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @include('partials.user_row')
                @endforeach
            </tbody>
        </table>

        @if ($users->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</section>

@endsection