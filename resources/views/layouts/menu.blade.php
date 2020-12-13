<li class="{{ Request::is('posts*') ? 'active' : '' }}">
    <a href="{{ route('posts.index') }}"><i class="fa fa-edit"></i><span>Posts</span></a>
</li>

@role('admin')
    <li class="{{ Request::is('categories*') ? 'active' : '' }}">
        <a href="{{ route('categories.index') }}"><i class="fa fa-edit"></i><span>Categories</span></a>
    </li>

    <li class="{{ Request::is('roles*') ? 'active' : '' }}">
        <a href="{{ route('roles.index') }}"><i class="fa fa-edit"></i><span>Roles</span></a>
    </li>

    <li class="{{ Request::is('permissions*') ? 'active' : '' }}">
        <a href="{{ route('permissions.index') }}"><i class="fa fa-edit"></i><span>Permissions</span></a>
    </li>
@endrole


