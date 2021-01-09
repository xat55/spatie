<div class="container">
    <h4 class="blog-post-title">Полный текст статьи '{{ $post->header }}'</h4>
    <p class="blog-post-meta">
      {{ $post->getPostDate() }} by        
      {{ $post->user->name }},             
      рубрика: {{ $post->categories->implode('name', ', ') }}
    </p>          
    <p>{{ $post->text }}</p>
    <a href="{{ route('main') }}" class="btn btn-outline-secondary my-2 my-sm-0" role="button">Back</a>
</div>