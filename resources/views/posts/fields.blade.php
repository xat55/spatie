<!-- Header Field -->
<div class="form-group col-sm-6">
    {!! Form::label('header', 'Header:') !!}
    {!! Form::text('header', null, ['class' => 'form-control','maxlength' => 128,'maxlength' => 128]) !!}
</div>

<!-- Text Field -->
@can('publish articles')
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('text', 'Text:') !!}
        {!! Form::textarea('text', null, ['class' => 'form-control']) !!}
    </div>
@endcan

<!-- Author Field -->
@role('admin')
    <div class="form-group col-sm-6">
        {!! Form::label('author', 'Author:') !!}
        {!! Form::text('author', $user->name, ['class' => 'form-control','maxlength' => 64,'maxlength' => 64]) !!}
    </div>
@endrole

<!-- Categories Field -->
<div class="form-group col-sm-6">
    {!! Form::label('categories', 'Categories:') !!}   
    <p>
        {!! Form::select('categories[]', $categories, null, ['class' => 'form-control', 'multiple' => true,'maxlength' => 64,'maxlength' => 64]) !!}
    </p> 
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('posts.index') }}" class="btn btn-default">Cancel</a>
</div>
