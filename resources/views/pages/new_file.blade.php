@extends('layouts.app')

@section('content')

<section class="container">
    <h2>New File</h2>
    <p>Upload a new file</p>
    <div class="row">
        <div class="col-6">
            <form action="/upload_file" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <button type="submit" class="btn-solid theme-success mt-2">Upload</button>
                @include('partials.form_errors', ['errors' => $errors])
            </form>
        </div>
    </div>
</section>

@endsection