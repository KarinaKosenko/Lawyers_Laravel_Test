<strong>Please, read <a href="{{ route('public.auth.conditions') }}">Terms and Conditions.</a></strong><br>
<form method="post">
    {{ csrf_field() }}

    @include('forms.registration_form')

    <div class="form-group{{ $errors->has('is_confirmed') ? ' has-error' : ''}}">
        <label class="control-label" for="input-is_confirmed">Accept Terms and Conditions *</label>
        <input type="checkbox" id="input-is_confirmed" name="is_confirmed">
        @if ($errors->has('is_confirmed'))
            <span class="help-block">{{ $errors->first('is_confirmed') }}</span>
        @endif
    </div>
    <br>
    <button class="btn btn-primary" type="submit" value="Sign Up">Sign Up</button>
</form>