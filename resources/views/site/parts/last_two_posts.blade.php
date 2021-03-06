<div class="row mb-2">    
    @set($i, 1)
    
    @foreach($posts as $post)
        @php $i++ @endphp
        
        @if($post->user->hasRole('banned'))
            @php $i-- @endphp
            @continue
        @else
            <div class="col-md-6">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">    
                        <strong class="d-inline-block mb-2 text-primary">{{ $post->categories->implode('name', ', ') }}</strong>
                        <h3 class="mb-0">{{ $post->header }}</h3>
                        <div class="mb-1 text-muted">{{ $post->getPostDateWithoutYear() }}</div>
                        <p class="card-text mb-auto">{{ Str::limit($post->text, 110) }}</p>
                        <a href="{{ route('single_post', $post) }}" class="stretched-link">Continue reading</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                    </div>
                </div>
            </div>
        @endif
        
        @if($i > 2)
            @break
        @endif    
    @endforeach
</div>
