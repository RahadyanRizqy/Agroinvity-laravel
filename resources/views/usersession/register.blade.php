@extends('master')

@section('title', 'Register')

@push('style')
  <link rel="stylesheet" href="{{ asset('css/usersession.css') }}">
@endpush

@section('content')
<section class="register">
    <div class="row g-0">
        <div class="col-md-6 g-0">
            <div class="form-right-side d-flex justify-content-center align-items-center">
                <form action="{{ route('register.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="fullname" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="fullname" placeholder="cth: Arcueid Brunestud" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="form-label">Nomor Handphone</label>
                        <input type="number" class="form-control" name="phone_number" placeholder="cth: 62xxxxxxxxxxx" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Alamat email</label>
                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="cth: arcueidbrune@stud.com" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="cth: arc2512" required>
                    </div>
                        <button type="submit" class="btn form-button btn-success">Daftar</button>
                    <div>
                        <span class="ask">Sudah punya akun? <a href="login">Masuk</a> sekarang juga!</span>
                    </div>
                    @if ($errors->any())
                    <div class="mt-2">
                        <span class="warning" style="color: white;">Akun sudah ada, Silahkan login!</span>
                    </div>
                    <div class="mt-1 col-md-12">
                        <span class="warning" style="color: white;">Bila lupa password silahkan <a href="{{ route('request.token')}}" style="color: white" target="_blank"> reset password</a></span>
                    </div>
                    @endif
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