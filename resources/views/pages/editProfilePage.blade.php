<form method="post">
    {{ csrf_field() }}

    Full Name: *<br>
    <input type="text" name="name" value="{{ $user->name }}"><br>
    @if ($errors->has('name'))
        <div class="warning_message">
            <strong> {{ $errors->first('name') }} </strong>
        </div>
    @endif
    <br>

    Address: *<br>
    <input type="text" name="address" value="{{ $user->address }}"><br>
    @if ($errors->has('address'))
        <div class="warning_message">
            <strong> {{ $errors->first('address') }} </strong>
        </div>
    @endif
    <br>

    E-mail: *<br>
    <input type="text" name="email" value="{{ $user->email }}"><br>
    @if ($errors->has('email'))
        <div class="warning_message">
            <strong> {{ $errors->first('email') }} </strong><br>
        </div>
    @endif
    <br>

    Mobile Phone: *<br>
    <input type="text" name="phone" value="{{ $user->phone }}"><br>
    @if ($errors->has('phone'))
        <div class="warning_message">
            <strong> {{ $errors->first('phone') }} </strong><br>
        </div>
    @endif
    <br>

    Date of Birth: *<br>
    <input type="text" name="birthday" value="{{ $user->birthday }}"><br>
    @if ($errors->has('birthday'))
        <div class="warning_message">
            <strong> {{ $errors->first('birthday') }} </strong><br>
        </div>
    @endif
    <br>

    Date of Bar Admission: *<br>
    <input type="text" name="date" value="{{ $user->date }}"><br>
    @if ($errors->has('date'))
        <div class="warning_message">
            <strong> {{ $errors->first('date') }} </strong><br>
        </div>
    @endif
    <br>

    Password: *<br>
    <input type="password" name="password"><br>
    @if ($errors->has('password'))
        <div class="warning_message">
            <strong> {{ $errors->first('password') }} </strong><br>
        </div>
    @endif
    <br>

    Repeat Password: *<br>
    <input type="password" name="password2"><br>
    @if ($errors->has('password2'))
        <div class="warning_message">
            <strong> {{ $errors->first('password2') }} </strong><br>
        </div>
    @endif
    <br>
    <input type="submit" value="Submit">
</form>