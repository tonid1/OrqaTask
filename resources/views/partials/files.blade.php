<section class="container">
    <h2>Files</h2>
    <p>Upload & download your files</p>
    <a href="/new_file" class="btn-solid theme-primary">New file</a>

    <div class="row py-8">
        <table class="table">
            <thead>
                <tr class="theme-inverse">
                    <th scope="col"></th>
                    <th scope="col">Name</th>
                    <th scope="col">Added</th>
                    <th scope="col">Size</th>
                    @if (auth()->user()->role == 'super')
                        <th scope="col">Added by</th>
                    @endif
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $file)
                    @include('partials.file_row')
                @endforeach
            </tbody>
        </table>

        @if ($files->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $files->links() }}
            </div>
        @endif
    </div>

</section>