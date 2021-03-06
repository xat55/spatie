<!-- Header Field -->
<div class="form-group">
    {!! Form::label('header', 'Header:') !!}
    <p>{{ $post->header }}</p>
</div>

<!-- Text Field -->
<div class="form-group">
    {!! Form::label('text', 'Text:') !!}
    <p>{{ $post->text }}</p>
</div>

<!-- Author Field -->
@role('admin')
    <div class="form-group">
        {!! Form::label('author', 'Author:') !!}
        <p>{{ $post->user->name }}</p>
    </div>
@endrole

<!-- Category Field -->
<div class="form-group">
    {!! Form::label('categories', 'Categories:') !!}
    <p>{{ $post->categories->implode('name', ', ') }}</p>
</div>

