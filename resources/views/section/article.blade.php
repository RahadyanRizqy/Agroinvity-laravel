<main>
    <h1 class="title">Article</h1>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Title</th>
            <th>Content</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($articles as $article)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/image/{{ $article->image }}" width="100px"></td>
            <td>{{ $article->title }}</td>
            <td>{{ $article->text }}</td>
            <td>
                <form action="{{ route('articles.destroy',$article->id) }}" method="POST">
                    
                    {{-- <a class="btn btn-info" href="{{ route('articles.show', $article->id) }}">Show</a> --}}
                    <a class="btn btn-info" href="{{ route('articles.show', $article->id) }}">Show</a>
                    
      
                    <a class="btn btn-primary" href="{{ route('articles.edit', $article->id) }}">Edit</a>
                    
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $articles->links() }}
</main>