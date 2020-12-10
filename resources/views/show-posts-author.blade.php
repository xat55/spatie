@extends('posts.main')

@section('content')
  <div class="mt-4">
    <h3>Список статей автора '{{ $nameAuthor }}'</h3>
  </div>
  <table class="table table-striped table-bordered table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col">Заголовок</th>
        <th scope="col">Рубрика</th>
        <th scope="col">Статья</th>
      </tr>
    </thead>
    <tbody>    
      @forelse($posts as $post)
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $post->header }}</td>
          <td>{{ $post->categories()->pluck('name')->implode(', ') }}</td>
          <td>{{ $post->text }}</td>          
        </tr>
        @empty
          <p>У автора с именем '{{ $post->author }}' статей нет</p>
        @endforelse
    </tbody>
  </table>  
@endsection