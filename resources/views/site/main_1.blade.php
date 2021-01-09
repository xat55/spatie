@extends(env('THEME').'.layout')

@section('header')
    @includeIf(env('THEME').'.parts.header')
@endsection



@section('categories_menu_v')
    {!! $categoriesMenu !!}
@endsection

@section('two_latest_news')
    @includeIf(env('THEME').'.parts.two_latest_news')
@endsection

@section('content')
    @includeIf(env('THEME').'.parts.content')
@endsection

@section('sidebar')
    @includeIf(env('THEME').'.parts.sidebar')
@endsection

@section('footer')
    @includeIf(env('THEME').'.parts.footer')
@endsection


<div class="row">
    <div class="col-md-12">
        <nav aria-label="Page navigation">
            {{ $posts->links() }}
        </nav>
    </div>
</div>

<nav class="blog-pagination">
  <a class="btn btn-outline-primary" href="#">Older</a>
  <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
</nav>