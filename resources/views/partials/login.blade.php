<section class="container">
    <h2>Login</h2>
    <form action="/login" method="POST">
        @csrf
        <div class="row">
            <div class="col-4 form-group">
                <label for="name">Username</label>
                <input type="text" name="name" id="name" class="form-control" />
            </div>
            <div class="col-4 form-group">
                <label for="passworw">Password</label>
                <input type="password" name="password" id="password" class="form-control" />
            </div>
            <div class="col-2 form-group align-self-end">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

            @include('partials.form_errors', ['errors' => $errors])
        </div>
    </form>

    <p>Don't have an account? <a href="/register">Register</a></p>
</section>