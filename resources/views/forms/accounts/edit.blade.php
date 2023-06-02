@extends('master')

@if($account->account_type_fk == 3)
    @section('title', 'Ubah Akun Pegawai')
@else
    @section('title', 'Profil Akun')
@endif

@push('style')
<style>
    body {
        font-family: Poppins;
        margin: 0;
        background-color: #057455;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
    .form-label {
        color: white;
    }

    .form-container {
        background-color: #263043;
        width: 900px;
        height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
        box-shadow: 5px 5px 5px 5px #263043;
        flex-direction: column;
        position: static;
    }

    form > div > .ask {
        color: white;
    }
    
    .form-group {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .sweetalert {
        z-index: 100;
    }
</style>
@endpush

<div class="sweetalert">
    {{ $message = ""}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Ups',
            text: '{{ $errors->first() }}',
            position: 'top-center',
            footer: '<a href=""></a>'
        })
    </script>
    @endif
</div>

@section('content')
<div class="content">
    <div class="form-container">
        <div class="edit-form col-4">
            <form id="account-crud-form" action="{{ route('accounts.update', $account->id )}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="fullname" class="form-label">Nama Akun</label>
                    <input type="text" class="form-control" name="fullname" placeholder="cth: Arcueid Brunestud" value="{{ $account->fullname }}">
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="cth: arcueidbrunestud@gmail.com" value="{{ $account->email }}">
                </div>
                <div class="form-group">
                    <label for="phone_number" class="form-label">Nomor HP</label>
                    <input type="number" class="form-control" name="phone_number" placeholder="cth: 6281225120012"  value="{{ $account->phone_number }}">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="cth: rahasia" value="">
                </div>
                <button type="submit" class="btn form-button btn-success" name="save-btn">Perbarui</button>
                <a class="btn btn-danger" href="{{ route('section.account')}}">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection