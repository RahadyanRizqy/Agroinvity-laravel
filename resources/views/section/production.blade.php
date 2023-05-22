<main>
    <h1 class="title">Produksi</h1>
    <button class="btn btn-primary mb-3" onClick="inputForm(3)">+ Tambah Product</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="page" class="p-2"></div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jumlah Total</th>
            <th>Harga Per Satuan</th>
            <th>Produk Terjual</th>
            <th>Produk Tak Terjual</th>
            <th>Waktu Input</th>
            <th width="280px">Proses</th>
        </tr>
        @foreach ($productions as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->total_qty }}</td>
            <td>{{ $product->price_per_qty }}</td>
            <td>{{ $product->sold_products }}</td>
            <td>{{ $product->stock_products }}</td>
            <td>{{ $product->created_at }}</td>
            <td>
                <form action="{{ route('articles.destroy',1) }}" method="POST">
                    
                    {{-- <a class="btn btn-info" href="{{ route('articles.show', $article->id) }}">Show</a> --}}
                    <a class="btn btn-info" href="{{ route('articles.show', 1) }}">Show</a>
                    
      
                    <a class="btn btn-primary" href="{{ route('articles.edit', 1) }}">Edit</a>
                    
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
</main>
