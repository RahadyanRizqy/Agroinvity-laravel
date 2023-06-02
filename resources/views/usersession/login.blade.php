@extends('master')

@section('title', 'Login')

@push('style')
  <link rel="stylesheet" href="{{ asset('css/usersession.css') }}">
@endpush

@section('content')
<section class="login">
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
    <div class="row g-0">
        <div class="col-md-6 g-0">
            <div class="form-left-side d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <h2>Selamat Datang di Agroinvity</h2>
                    <p>
                        Silahkan masuk dengan akun anda untuk memulai menggunakan Agroinvity!
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 g-0">
            <div class="form-right-side d-flex justify-content-center align-items-center">
                
                <form action="{{ route('login.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Alamat email</label>
                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Masukkan email anda" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password anda" required>
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
                        <button type="submit" class="btn form-button btn-success">Masuk</button>
                    <div>
                        <span class="ask">Belum punya akun? <a href="register">Daftar</a> sekarang juga!</span>
                    </div>
                    @if(session()->has('loginError'))
                    <div class="mt-2">
                        <span class="warning" style="color: white;">{{session('loginError')}}</span>
                    </div>
                    <div class="mt-1 col-md-12">
                        <span class="warning" style="color: white;">Bila lupa password silahkan <a href="{{ route('request.token')}}" style="color: white" target="_blank"> reset password</a></span>
                    </div>
                    @else
                    <a href="{{ route('request.token')}}" style="color: white" target="_blank">Lupa password?</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</section>
@endsection