<div class="container">
    
    @if(count($posts) > 0)
        <div class="mt-4">
            <h3>Список статей автора '{{ $user->name }}'</h3>
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
                @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{ $loop->index + $posts->firstItem() }}</th>
                        <td>{{ $post->header }}</td>
                        <td>{{ $post->categories->implode('name', ', ') }}</td>
                        <td>{{ $post->text }}</td>          
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="mt-4">
            <h3>У автора '{{ $user->name }}' статей нет.</h3>
        </div>
    @endif
    
    {{ $posts->links() }}
    <a href="{{ route('main') }}" class="btn btn-outline-secondary my-2 my-sm-0" role="button">Back</a
</div>