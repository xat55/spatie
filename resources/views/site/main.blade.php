@extends(env('THEME').'.layout')

@section('header')
    @includeIf(env('THEME').'.parts.header')
@endsection

@section('navigation')
    {!! $navigation !!}
@endsection

@section('last_two_posts')
    {!! $lastTwoPosts !!}
@endsection

@section('content')
    {!! $content !!}
@endsection

@section('sidebar')
    {!! $sidebar !!}
@endsection

@section('footer')
    @includeIf(env('THEME').'.parts.footer')
@endsection