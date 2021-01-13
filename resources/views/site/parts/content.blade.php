<div class="col-md-8 blog-main">
    
    <h3 class="pb-4 mb-4 font-italic border-bottom">
        From the Firehose
    </h3>  
    
    <div class="blog-post">    
        @foreach($posts as $post)            
            
            @if(!$post->user->hasRole('banned'))
                <a href="{{ route('single_post', $post) }}"><h4 class="blog-post-title">{{ $post->header }}</h4></a>
                <p class="blog-post-meta">
                    {{ $post->getPostDate() }} by        
                    <a href="{{ route('show_posts_author', $post->user_id) }}">{{ $post->user->name }}, </a>             
                    рубрика: {{ $post->categories->implode('name', ', ') }}
                </p>          
                <p>{{ Str::limit($post->text, 80, '... [') }}         
                    <a href="{{ route('single_post', $post) }}"><small>Read more</small></a>    
                    ]
                </p>  
            @endif
        @endforeach
    </div><!-- /.blog-post -->
    
    {{ $posts->links() }}
    
</div><!-- /.blog-main -->