@extends('forms/form_layout')

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

    *{
        padding: 0;
        margin: 0;
    }

    body{
        font-family: Poppins;
        background-image: url('/assets/img/background.png');
        background-size: cover;
    }

    .formcontainer{
        
        position: absolute;
        top: 18vh;
        padding: 50px;
        border-radius: 10px;
        box-shadow: 0px 5px 50px #000;
        color:#1E1E1E;
        font-size:14px;
        font-weight:bold;
        width:30%;
        background: #004b2db8;

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
<section class="container-fluid">
    <section class="row justify-content-center">
        <section class="col-12 col-sm-4 col-md-4">
            <form class="formcontainer" id="account-crud-form" action="{{ route('accounts.update', $account->id )}}" method="POST" enctype="multipart/form-data">
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
                    <input type="password" class="form-control" name="password" id="password" placeholder="cth: rahasia" value="">
                </div>
                <input type="checkbox" id="showPasswordCheckbox"><span style="color: white"> Tampilkan/Sembunyikan password</span><br>
                <script>
                    $(document).ready(function() {
                        $('#showPasswordCheckbox').change(function() {
                            var passwordField = $('#password');
                            var isChecked = $(this).is(':checked');
                            
                            if (isChecked) {
                                passwordField.attr('type', 'text');
                            } else {
                                passwordField.attr('type', 'password');
                            }
                            });
                        });
                </script>
                <button type="submit" class="btn form-button btn-success" name="save-btn">Perbarui</button>
                <a class="btn btn-danger" href="{{ url()->previous() }}">Batal</a>
            </form>
        </section>
    </section>
</section>
@endsection