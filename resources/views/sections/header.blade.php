<header>
    <nav class="navbar lg:navbar-expand bg-1" data-bs-theme="dark">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <ul class="nav navbar-nav me-auto">
                <li class="nav-item">
                    <h5 class="nav-link active">Cloud App</h5>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">
                        @auth
                        Files
                        @else
                        Login
                        @endauth
                    </a>
                </li>
                @if (auth()->user()?->role == 'super')
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/users">Users</a>
                    </li>
                @endif
            </ul>
            @auth
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/edit_user/{{ auth()->user()?->id }}">{{ auth()->user()?->name }}</a>
                </li>
                <li class="nav-item">
                    <form action="/logout" method="POST" class="nav-link mb-0">
                        @csrf
                        <button class="btn">Logout</button>
                    </form>
                </li>
            </ul>
            @endauth
        </div>
    </nav>
</header>