<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Verified At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    {!! Form::text('email_verified_at', null, ['class' => 'form-control','id'=>'email_verified_at']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#email_verified_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Two Factor Secret Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('two_factor_secret', 'Two Factor Secret:') !!}
    {!! Form::textarea('two_factor_secret', null, ['class' => 'form-control']) !!}
</div>

<!-- Two Factor Recovery Codes Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('two_factor_recovery_codes', 'Two Factor Recovery Codes:') !!}
    {!! Form::textarea('two_factor_recovery_codes', null, ['class' => 'form-control']) !!}
</div>

<!-- Remember Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    {!! Form::text('remember_token', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100]) !!}
</div>

<!-- Current Team Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('current_team_id', 'Current Team Id:') !!}
    {!! Form::number('current_team_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Profile Photo Path Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('profile_photo_path', 'Profile Photo Path:') !!}
    {!! Form::textarea('profile_photo_path', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
</div>
