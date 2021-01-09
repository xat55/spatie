<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">                    
        <div class="col-4 pt-1">
            <a class="text-muted" href="{{ route('posts.create') }}">Разместить статью</a>
        </div>
        <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="{{ route('main') }}">Large</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
            
            <nav class="mr-3">
                <form style="display: flex;" class="abc" method="GET" action="{{ route('search') }}">
                    <input name="s" class="form-control btn-sm mr-sm-2 @error('s') is-invalid @enderror" type="search" placeholder="Search" aria-label="Search" required>
                    <button class="btn btn-outline-secondary btn-sm my-2 my-sm-0" type="submit">Search</button>
                </form>
            </nav>
            <!-- <a class="text-muted" href="{{ route('search') }}" aria-label="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
        </a>             -->
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
    <!-- <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
    <div>{{ Auth::user()->name }}</div>
    
    <div class="ml-1">
    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
</svg>
</div>
</button> -->
@else
<a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Sign&nbsp;in</a>
<a class="btn btn-sm btn-secondary ml-1" href="{{ route('register') }}">Sign&nbsp;up</a>
@endif
</div>

<!-- @if (Route::has('login'))
<div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
@auth
<a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
@else
<a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

@if (Route::has('register'))
<a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
@endif
@endif
</div>
@endif -->
</div>
</header>




<!-- <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
<div class="col-md-6 px-0">
<h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
<p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
<p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
</div>
</div> -->
