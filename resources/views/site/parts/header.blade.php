<header class="blog-header py-3" name="top">
    <div class="row flex-nowrap justify-content-between align-items-center">                    
        <div class="col-4 pt-1">
            <a class="text-muted" href="{{ route('posts.create') }}">Разместить статью</a>
        </div>
        <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="{{ route('main') }}">Large</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">        
            <nav class="mr-3">
                <form style="display: flex;" class="" method="GET" action="{{ route('search') }}">
                    <input name="s" class="form-control btn-sm mr-sm-2 @error('s') is-invalid @enderror" type="search" placeholder="Search" aria-label="Search" required>
                    <button class="btn btn-outline-secondary btn-sm my-2 my-sm-0" type="submit">Search</button>
                </form>
            </nav>
            
            @if(Auth::check())                                                
                <div class="dropdown">                
                    <a class="nav-link dropdown-toggle text-muted" href="#" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item text-muted" href="{{ route('posts.index') }}">{{ __('Your articles') }}</a>
                        <a class="dropdown-item text-muted" href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf    
                            <a class="dropdown-item text-muted" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </form>
                    </div>
                </div>
            @else
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Sign&nbsp;in</a>
                <a class="btn btn-sm btn-secondary ml-1" href="{{ route('register') }}">Sign&nbsp;up</a>
            @endif
        </div>
    </div>
</header>