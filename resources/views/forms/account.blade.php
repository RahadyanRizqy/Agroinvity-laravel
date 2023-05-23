@extends('master')

@section('title', 'Profil Akun')

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

@section('content')
<div class="content">
    <div class="form-container">
        <div class="edit-form col-4">
            <form id="account-crud-form" action="#" method="post">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Nama Akun</label>
                    <input type="text" class="form-control" name="name" placeholder="cth: Pestisida X" value="" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="cth: 2" value="" required>
                </div>
                <div class="form-group">
                    <label for="phone_number" class="form-label">Nomor HP</label>
                    <input type="number" class="form-control" name="phone_number" placeholder="cth: 55000" name="priceInput" value="" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" placeholder="cth: 2" value="" required>
                </div>
                <button type="submit" class="btn form-button btn-success" name="save-btn">Tambahkan</button>
                <a class="btn btn-danger" href="{{ route('section.main')}}">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection