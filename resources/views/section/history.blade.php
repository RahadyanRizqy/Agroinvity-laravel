<main>
    <h1 class="title mb-3">Riwayat</h1>
    @if ($table_type == 1)
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jumlah Total</th>
            <th>Harga Per Satuan</th>
            <th>Tanggal Perubahan</th>
        </tr>
        @foreach($expense_histories as $eh)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $eh->name }}</td>
            <td>{{ $eh->quantity }}</td>
            <td>{{ $eh->price_per_qty }}</td>
            <td>{{ $eh->updated_at }}</td>
        </tr>
        @endforeach
    </table>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    @elseif ($table_type == 2)
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jumlah Total</th>
            <th>Harga Per Satuan</th>
            <th>Produk Terjual</th>
            <th>Produk Tak Terjual</th>
            <th>Tanggal Perubahan</th>
        </tr>
        @foreach ($product_histories as $ph)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $ph->name }}</td>
            <td>{{ $ph->total_qty }}</td>
            <td>{{ $ph->price_per_qty }}</td>
            <td>{{ $ph->sold_products }}</td>
            <td>{{ $ph->stock_products }}</td>
            <td>{{ $ph->updated_at }}</td>
        </tr>
        @endforeach
    </table>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    @endif
</main>
