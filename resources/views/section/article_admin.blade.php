<main>
    <h1>Daftar Artikel</h1>
    <a class="btn btn-primary mb-3" href="{{ route('articles.create')}}">+ Tambah Artikel</a>
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
            <td>{{ \Illuminate\Support\Str::limit($article->text, $limit = 300, $end="...") }}</td>
            <td>
                <form action="{{ route('articles.destroy',$article->id) }}" method="POST">
                    
                    {{-- <a class="btn btn-info" href="{{ route('articles.show', $article->id) }}">Show</a> --}}
                    {{-- <a class="btn btn-info" href="{{ route('articles.show', $article->id) }}">Show</a> --}}
                    
      
                    <a class="btn btn-primary" href="{{ route('articles.edit', $article->id) }}">Edit</a>
                    
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{-- {{ $articles->links() }} --}}
</main>