<main>
    <h2>{{ $article->title }}</h2>
    <img src="/image/{{ $article->image }}" alt="" srcset="" width="300px">
    <?php $text = $article->text ?>
    <div class="mt-3">          
        <?php echo nl2br($text)?>
    </div>
</main>