@section('content')
    <div class="col-lg-12">
        <hr>
        <h2 class="intro-text text-center">
            <strong>Welcome, {{ $user->name }}!</strong>
        </h2>
        <hr>
        <img class="img-responsive img-border img-left" src="img/intro-pic.jpg" alt="">
        <hr class="visible-xs">
        <a href="{{ route('public.profiles.edit', ['id_user' => $user->id]) }}">Edit profile</a><br>
        <a href="{{ route('public.images.index', ['id_user' => $user->id]) }}">Edit images</a>
    </div>
@endsection