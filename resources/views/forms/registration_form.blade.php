<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
    <label class="control-label" for="input-name">Full Name: *</label>
    <input type="text" class="form-control" id="input-name" name="name" value="{{ isset($user) ? $user->name : old('name') }}">
    @if ($errors->has('name'))
        <span class="help-block">{{ $errors->first('name') }}</span>
    @endif
</div>

<div class="form-group{{ $errors->has('address') ? ' has-error' : ''}}">
    <label class="control-label" for="input-address">Address: *</label>
    <input type="text" class="form-control" id="input-address" name="address" value="{{ isset($user) ? $user->address : old('address') }}">
    @if ($errors->has('address'))
        <span class="help-block">{{ $errors->first('address') }}</span>
    @endif
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
    <label class="control-label" for="input-email">E-mail: *</label>
    <input type="email" class="form-control" id="input-email" name="email" value="{{ isset($user) ? $user->email : old('email') }}">
    @if ($errors->has('email'))
        <span class="help-block">{{ $errors->first('email') }}</span>
    @endif
</div>

<div class="form-group{{ $errors->has('phone') ? ' has-error' : ''}}">
    <label class="control-label" for="input-phone">Mobile Phone: *</label>
    <input type="text" class="form-control" id="input-phone" name="phone" value="{{ isset($user) ? $user->phone : old('phone') }}">
    @if ($errors->has('phone'))
        <span class="help-block">{{ $errors->first('phone') }}</span>
    @endif
</div>

<div class="form-group{{ $errors->has('birthday') ? ' has-error' : ''}}">
    <label class="control-label" for="input-birthday">Date of Birth: *</label>
    <input type="date" class="form-control" id="input-birthday" name="birthday" placeholder="YYYY-MM-DD" value="{{ isset($user) ? $user->birthday : old('birthday') }}">
    @if ($errors->has('birthday'))
        <span class="help-block">{{ $errors->first('birthday') }}</span>
    @endif
</div>

<div class="form-group{{ $errors->has('date') ? ' has-error' : ''}}">
    <label class="control-label" for="input-date">Date of Bar Admission: *</label>
    <input type="date" class="form-control" id="input-date" name="date" placeholder="YYYY-MM-DD" value="{{ isset($user) ? $user->date : old('date') }}">
    @if ($errors->has('date'))
        <span class="help-block">{{ $errors->first('date') }}</span>
    @endif
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
    <label class="control-label" for="input-password">Password: *</label>
    <input type="password" class="form-control" id="input-password" name="password">
    @if ($errors->has('password'))
        <span class="help-block">{{ $errors->first('password') }}</span>
    @endif
</div>

<div class="form-group{{ $errors->has('password2') ? ' has-error' : ''}}">
    <label class="control-label" for="input-password2">Repeat Password: *</label>
    <input type="password" class="form-control" id="input-password2" name="password2">
    @if ($errors->has('password2'))
        <span class="help-block">{{ $errors->first('password2') }}</span>
    @endif
</div>