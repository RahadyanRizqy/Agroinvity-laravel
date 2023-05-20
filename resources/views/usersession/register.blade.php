@extends('main')

@section('title', 'Register')

@push('style')
  <link rel="stylesheet" href="{{ asset('css/usersession.css') }}">
@endpush

@section('content')
<section class="register">
    <div class="row g-0">
        <div class="col-md-6 g-0">
            <div class="form-right-side d-flex justify-content-center align-items-center">
                <form action="register" method="POST">
                    <div class="form-group">
                        <label for="fullNameInput" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="fullNameInput" placeholder="cth: Arcueid Brunestud" required>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumberInput" class="form-label">Nomor Handphone</label>
                        <input type="number" class="form-control" name="phoneNumberInput" placeholder="cth: 62xxxxxxxxxxx" required>
                    </div>
                    <div class="form-group">
                        <label for="mailInput" class="form-label">Alamat email</label>
                        <input type="email" class="form-control" name="mailInput" aria-describedby="emailHelp" placeholder="cth: arcueidbrune@stud.com" required>
                    </div>
                    <div class="form-group">
                        <label for="passwordInput" class="form-label">Password</label>
                        <input type="password" class="form-control" name="passwordInput" placeholder="cth: arc2512" required>
                    </div>
                        <button type="submit" class="btn form-button btn-success" name="regist-btn">Daftar</button>
                    <div>
                        <span class="ask">Sudah punya akun? <a href="login">Masuk</a> sekarang juga!</span>
                    </div>
                    <div class="mt-2">
                        {{-- <?php
                            // $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

                            // if($pageWasRefreshed) {
                            //     $accountExist = False;
                            // } 
                            // else {
                                if ($accountExist == True) {
                                    echo "<span class=\"warning\" style=\"color: white;\">Akun sudah ada, Silahkan login!</span>";
                                } else if ($accountExist == False) {
                                    echo "<span class=\"warning\" style=\"color: white;\"></span>";
                                }
                            // }
                        ?> --}}
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 g-0">
            <div class="form-left-side d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <!-- <div class="mb-lg-3">
                        
                    </div> -->
                    <div>
                        <h2>Selamat Datang di Agroinvity</h2>
                        <p>
                            Silahkan mendaftarkan diri anda sesuai form yang telah disediakan dengan keterangan yang valid untuk memulai menggunakan Agroinvity!
                        </p> 
                    </div>   
                </div>
            </div>
        </div>
    </div>
</section>
@endsection