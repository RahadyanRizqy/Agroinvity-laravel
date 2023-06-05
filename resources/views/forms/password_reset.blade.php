@extends('forms.form_layout')

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
        height: 50vh;
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
        margin-top: 0px;
        margin-bottom: 10px;
    }

    .sweetalert {
        z-index: 100;
    }

    .form-container > p {
        color: white;
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
        height: 340px;
        top: 25vh;
        padding: 20px 50px 10px 50px;
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

    p {
        color: white;
    }
</style>
@endpush

<div class="sweetalert">
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
            @if ($expiredstatus == 0)
            <form class="formcontainer" id="account-crud-form" action="{{ route('token.accupdate', $account->id)}}" method="POST" enctype="multipart/form-data">
                <p class="text-center">Reset password pada email</p>
                <p class="text-center">{{$account->email}}</p>
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="password" class="form-label">Password (min 8)</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="cth: rahasia" value="">
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="cth: rahasia" value="">
                </div>
                <input type="checkbox" id="showPasswordCheckbox"><span style="color: white"> Tampilkan/Sembunyikan password</span><br>
                <script>
                    $(document).ready(function() {
                        $('#showPasswordCheckbox').change(function() {
                            var passwordField = $('#password');
                            var confirmField = $('#confirm_password');
                            var isChecked = $(this).is(':checked');
                            
                            if (isChecked) {
                                passwordField.attr('type', 'text');
                                confirmField.attr('type', 'text');
                            } else {
                                passwordField.attr('type', 'password');
                                confirmField.attr('type', 'password')
                            }
                            });
                        });
                </script>
                <button type="submit" class="btn form-button btn-success" name="save-btn">Perbarui</button>
            </form>
        @elseif ($expiredstatus == 1)
        <div class="formcontainer d-flex align-items-center">
            <h3 class="text-center" style="color: white;">Token habis silahkan lakukan permintaan lagi</h3>
        </div>
        @elseif ($expiredstatus == 2)
        <div class="formcontainer d-flex align-items-center">
            <h3 class="text-center" style="color: white;">Token tidak valid</h3>
        </div>
        @endif
        </section>
    </section>
</section>
{{-- <div class="content">
    <div class="form-container">
        
    </div>
</div> --}}
@endsection