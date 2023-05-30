<main>
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
    @if ($type_id == 1)
        <h1 class="title">Bahan Baku</h1>
        <a class="btn btn-primary mb-3" href="{{ route('expenses.create', ['type_id' => 1])}}">+ Tambah Bahan Baku</a>
    @elseif ($type_id == 2)
        <h1 class="title">Operasional</h1>
        <a class="btn btn-primary mb-3" href="{{ route('expenses.create', ['type_id' => 2])}}">+ Tambah Operasional</a>
    @else
        <h1 class="title">Belum Ada Data</h1>
        <a class="btn btn-primary mb-3" href="{{ route('expenses.create', ['type_id' => $type_id])}}">+ Tambah Data</a>
    @endif
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
          <th>Jumlah</th>
          <th>Harga Per Satuan</th>
          <th>Waktu Input</th>
          <th width="280px">Proses</th>
      </tr>
      @foreach ($expenses as $expense)
      <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $expense->name }}</td>
          <td>{{ $expense->quantity }}</td>
          <td>{{ $expense->price_per_qty }}</td>
          <td>{{ $expense->stored_at }}</td>
          <td>
              <form action="{{ route('expenses.destroy',$expense->id) }}" method="POST">
                  
                  {{-- <a class="btn btn-info" href="{{ route('articles.show', $article->id) }}">Show</a> --}}
                  {{-- <a class="btn btn-info" href="{{ route('ex.show', 1) }}">Show</a> --}}
                  <a class="btn btn-primary" href="{{ route('expenses.edit', $expense->id) }}">Edit</a>
                  @csrf
                  @method('DELETE')
                  
                  <button type="submit" class="btn btn-danger">Hapus</button>
              </form>
          </td>
      </tr>
      @endforeach
    </table>
  {{-- {{ $expenses->links() }} --}}
    {{-- <form action="./dashboard.php" method="POST">
        <table class="table table-bordered mt-3">
          <thead>
              <tr>
              <th scope="col">No</th>
              <th scope="col">ID Artikel</th>
              <th scope="col">Judul</th>
              <th scope="col">Isi Artikel</th>
              <th scope="col">Tanggal dan Waktu Input</th>
              <th scope="col">Ubah</th>
              <th scope="col">Hapus</th>
              </tr>
          </thead>
          <tbody>
            <tr>
            <th scope="row"><?php echo 1 ?></th>
            <td><?php echo 1 ?></td>
            <td><?php echo 1 ?></td>
            <td><?php echo 1 ?></td>
            <td><?php echo 1 ?></td>
            <form action="./dashboard.php" method="post">
                <input type="hidden" name="data-id4" value="<?php echo 1; ?>">
                <td> <input type="submit" id="change-btn4" name="change-btn4" class="btn btn-warning" value="Ubah"></td>
            </form>
            <form action="./dashboard.php" method="post">
                <input type="hidden" name="data-id4" value="<?php echo 1; ?>">
                <td> <input type="submit" id="delete-btn4" name="delete-btn4" class="btn btn-danger" value="Hapus"></td>
            </form>
            </tr>
          </tbody>
        </table>
      </form> --}}
</main>
<script>
    $(document).ready(function() {
        read()
    });
    // Read Database
    function read() {
        $.get("{{ url('read') }}", {}, function(data, status) {
            $("#read").html(data);
        });
    }
    // Untuk modal halaman create
    function create() {
        $.get("{{ url('expenses/create') }}", {}, function(data, status) {
            $("#exampleModalLabel").html('Create Product')
            $("#page").html(data);
            $("#exampleModal").modal('show');

        });
    }

    // untuk proses create data
    function store() {
        var name = $("#name").val();
        $.ajax({
            type: "get",
            url: "{{ url('store') }}",
            data: "name=" + name,
            success: function(data) {
                $(".btn-close").click();
                read()
            }
        });
    }

    // Untuk modal halaman edit show
    function show(id) {
        $.get("{{ url('show') }}/" + id, {}, function(data, status) {
            $("#exampleModalLabel").html('Edit Product')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }

    // untuk proses update data
    function update(id) {
        var name = $("#name").val();
        $.ajax({
            type: "get",
            url: "{{ url('update') }}/" + id,
            data: "name=" + name,
            success: function(data) {
                $(".btn-close").click();
                read()
            }
        });
    }

    // untuk delete atau destroy data
    function destroy(id) {

        $.ajax({
            type: "get",
            url: "{{ url('destroy') }}/" + id,
            data: "name=" + name,
            success: function(data) {
                $(".btn-close").click();
                read()
            }
        });
    }
</script>