@section('content')
    @forelse ($uploads as $upload)
        <li>
            <strong>{{ $upload->oldname }}</strong> |
            <a href="{{ route('public.images.show', [
                'path' => $upload->path . '.' . $upload->ext,
            ]) }}">Preview</a> |
            <a href="{{ route('public.images.delete', [
                'id_user' => $user->id,
                'id_upload' => $upload->id,
            ]) }}">Delete</a><br>
        </li>
    @empty
        <p>No uploads</p>
    @endforelse
@endsection