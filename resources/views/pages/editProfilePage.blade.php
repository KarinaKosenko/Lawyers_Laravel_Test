<form method="post">
    {{ csrf_field() }}

    @include('forms.registration_form')

    <br>
    <button class="btn btn-primary" type="submit" value="Save Changes">Sign Up</button>
</form>