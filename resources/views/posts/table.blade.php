@if(count($posts) > 0)
    <div class="table-responsive">
        <table class="table" id="posts-table">
            <thead>
                <tr>
                    <th>Header</th>
                    <th>Text</th>
                    <th>Categories</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->header }}</td>
                    <td>{{ $post->text }}</td>
                    <td>{{ $post->categories->implode('name', ', ') }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td> 
                        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                        <div class="btn-group">
                            <a href="{{ route('posts.show', [$post->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{{ route('posts.edit', [$post->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>
@else
    <p>Posts not found</p>
@endif