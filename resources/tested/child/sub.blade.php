@extends('main')

@section('title', 'Sub Class')

@push('style')
  <link rel="stylesheet" href="{{ asset('css/usersession.css') }}">
@endpush

@section('content')
<section class="login">
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
                <form action="login" method="POST">
                    <div class="form-group">
                        <label for="mailInput" class="form-label">Alamat email</label>
                        <input type="email" class="form-control" name="mailInput" aria-describedby="emailHelp" placeholder="Masukkan email anda" required>
                    </div>
                    <div class="form-group">
                        <label for="passwordInput" class="form-label">Password</label>
                        <input type="password" class="form-control" name="passwordInput" placeholder="Masukkan password anda" required>
                    </div>
                        <button type="submit" class="btn form-button btn-success" name="login-btn">Masuk</button>
                    <div>
                        <span class="ask">Belum punya akun? <a href="register">Daftar</a> sekarang juga!</span>
                    </div>
                    <div class="mt-2">
                        {{-- <?php
                            // $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

                            // if($pageWasRefreshed) {
                            //     $accountExist = False;
                            // } 
                            // else {
                                if ($accountExist == False) {
                                    echo "<span style=\"color: white;\">Akun tidak ditemukan / atau salah password!</span>" . "<br>";
                                    echo "<span style=\"color: white;\">Silahkan daftar / hubungi kontak di homepage!</span>" . "<br>";
                                } else if ($accountExist == True) {
                                    echo "<span class=\"warning\" style=\"color: white;\"></span>";
                                }
                            // }
                        ?> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection