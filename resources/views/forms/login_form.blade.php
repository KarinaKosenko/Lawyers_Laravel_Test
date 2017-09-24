<form method="post">
    {{ csrf_field() }}

    @if (session('authError'))
        <strong>{{ session('authError') }}</strong><br>
    @endif

    <label>E-mail: </label><br>
    <input type="text" name="email" value="{{ $login or ''}}"><br>
    <label>Password: </label><br>
    <input type="password" name="password"><br>
    <input type="checkbox" name="remember">Remember me<br><br>
    <input type="submit" value="Sign In">
</form>