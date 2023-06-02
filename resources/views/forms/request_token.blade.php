@extends('master')

{{-- @if($account->account_type_fk == 3)
    @section('title', 'Ubah Akun Pegawai')
@else
    @section('title', 'Profil Akun')
@endif --}}

@section('title', 'Reset Password')

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
        width: 500px;
        height: 30vh;
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
        margin-top: 5px;
        margin-bottom: 10px;
    }
    
    .form-container > p {
        color: white;
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
        <p>Konfirmasikan email</p>
        <div class="edit-form col-md-8">
            <form id="account-crud-form" action="{{ route('send.token') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="cth: rezaocta@gmail.com">
                </div>
                <button type="submit" class="btn btn-secondary" name="save-btn">Konfirmasi</button>
            </form>
        </div>
    </div>
</div>
@endsection