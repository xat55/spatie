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
<div class="form-group">
    {!! Form::label('author', 'Author:') !!}
    <p>{{ $post->author }}</p>
</div>

<!-- Is Admin Field -->
<div class="form-group">
    {!! Form::label('is_admin', 'Is Admin:') !!}
    <p>{{ $post->is_admin }}</p>
</div>

