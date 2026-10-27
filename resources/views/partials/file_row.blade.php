<tr>
    <td>
        <img src="{{ asset('storage/' . $file['file_type'] . '.png') }}" alt="Type icon">
    </td>
    <td>{{ $file['name'] }}</td>
    <td>{{ $file['created_at'] }}</td>
    <td>{{ $file['friendly_size'] }}</td>

    @if (auth()->user()->role == 'super')
        <td>{{ $file->user?->name }}</td>
    @endif

    <td class="d-flex justify-content-center">
        <a href="{{ route('file.download', $file->id) }}" class="btn-solid theme-primary mx-2">
            @include('icons.download')
        </a>
        <form action="/delete_file/{{ $file->id }}" method="POST" class="mb-0">
            @csrf
            @method('DELETE')

            <button class="btn-solid theme-danger">
                @include('icons.close')
            </button>
        </form>
    </td>
</tr>