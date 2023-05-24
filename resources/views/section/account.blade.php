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
    <h1 class="title">Data Akun Mitra</h1>
    <a class="btn btn-primary mb-3" href="{{ route('accounts.create')}}">Buat Akun Untuk Mitra ></a>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No. HP</th>
            <th>Waktu Pendaftaran</th>
        </tr>
        @foreach ($accounts as $account)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $account->fullname }}</td>
            <td>{{ $account->email }}</td>
            <td>{{ $account->phone_number }}</td>
            <td>{{ $account->registered_at }}</td>
        </tr>
        @endforeach
</main>
