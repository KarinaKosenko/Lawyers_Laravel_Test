@section('content')
    <form method="post">
        {{ csrf_field() }}

        @if (session('authError'))
            <strong>{{ session('authError') }}</strong><br>
        @endif

        E-mail:<br>
        <input type="text" name="email" value="{{ $login or ''}}"><br>
        Пароль:<br>
        <input type="password" name="password"><br>
        <input type="checkbox" name="remember">Запомнить<br>
        <input type="submit" value="Войти">
    </form>
@endsection