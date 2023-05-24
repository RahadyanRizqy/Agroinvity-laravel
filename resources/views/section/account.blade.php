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

    @if (Auth::user()->account_type_fk == 1)
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
    @elseif(Auth::user()->account_type_fk == 2)
    <h1 class="title">Data Akun Pegawai</h1>
    @if($accounts->count() == 0)
    <a class="btn btn-primary mb-3" href="{{ route('accounts.create')}}">Buat Akun Untuk Pegawai ></a>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No. HP</th>
            <th>Waktu Pendaftaran</th>
            <th>Action</th>
        </tr>
        @foreach ($accounts as $account)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $account->fullname }}</td>
            <td>{{ $account->email }}</td>
            <td>{{ $account->phone_number }}</td>
            <td>{{ $account->registered_at }}</td>
            <td>
                <form action="{{ route('accounts.destroy',$account->id) }}" method="POST">
                    
                    {{-- <a class="btn btn-info" href="{{ route('articles.show', $article->id) }}">Show</a> --}}
                    {{-- <a class="btn btn-info" href="{{ route('ex.show', 1) }}">Show</a> --}}
                    <a class="btn btn-primary" href="{{ route('accounts.edit', $account->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    @endif
</main>
