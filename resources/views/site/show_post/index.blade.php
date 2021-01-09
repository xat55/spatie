@extends(env('THEME').'.layout')

@section('header')
    @includeIf(env('THEME').'.parts.header')
@endsection

@section('navigation')
    {!! $navigation !!}
@endsection

@section('content')
    {!! $content_post !!}
@endsection
