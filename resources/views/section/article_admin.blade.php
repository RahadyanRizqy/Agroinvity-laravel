<main>
    <h1>Daftar Artikel</h1>
    @if ($message = Session::get('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire(
            'Berhasil',
            '{{ $message }}',
            'success'
        )
    </script>
    @endif
    <a class="btn btn-primary mb-3" href="{{ route('articles.create')}}">+ Tambah Artikel</a>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Title</th>
            <th width="400px">Content</th>
            <th>Waktu Posting</th>
            <th>Action</th>
        </tr>
        @foreach ($articles as $article)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/image/{{ $article->image }}" width="100px"></td>
            <td>{{ $article->title }}</td>
            <td>{{ \Illuminate\Support\Str::limit($article->text, $limit = 250, $end="...") }}</td>
            <td>{{ $article->posted_at }}</td>
            <td>
                <form action="{{ route('articles.destroy',$article->id) }}" method="POST">
                    
                    {{-- <a class="btn btn-info" href="{{ route('articles.show', $article->id) }}">Show</a> --}}
                    {{-- <a class="btn btn-info" href="{{ route('articles.show', $article->id) }}">Show</a> --}}
                    
      
                    <a class="btn btn-primary" href="{{ route('articles.edit', $article->id) }}">Edit</a>
                    
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{-- {{ $articles->links() }} --}}
</main>