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
        height: 40vh;
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

    .sweetalert {
        z-index: 100;
    }

    .form-container > p {
        color: white;
    }
</style>
@endpush

@section('content')
<div class="content">
    <div class="form-container">
        @if ($expiredstatus == 0)
        <p>Reset password pada email</p>
        <div class="edit-form col-md-8">
            <form id="account-crud-form" action="{{ route('token.accupdate', $account->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
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
        </div>
        @else
        <div class="edit-form col-md-8 expired-form">
            <h3 class="text-center" style="color: white;">Token habis silahkan lakukan permintaan lagi</h3>
        </div>
        @endif
    </div>
</div>
@endsection