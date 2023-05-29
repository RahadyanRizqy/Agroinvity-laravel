<main>
    <h1>Daftar Artikel</h1>

    @foreach ($articles as $article)
        <div class="mt-5">
            <h2>{{ $article->title }}</h2>
            <p>{{ \Illuminate\Support\Str::limit($article->text, $limit = 300, $end="...")}}<a href="{{ route('articles.show', $article->id)}}"> >> </a></p>
        </div>
    @endforeach
</main>