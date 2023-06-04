@extends('master')

@section('title', 'Agroinvity')

@push('style')
  <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endpush

@section('content')
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark position-fixed w-100" id="navbar">
    <div class="container">
      <a class="navbar-brand" href="#">
            <img src="assets/img/logo.png" alt="" width="30" class="d-inline-block align-text-top me-3">
        Agroinvity</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item mx-2">
            <a class="nav-link active" aria-current="page" href="#">BERANDA</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="#service">LAYANAN</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="https://wa.me/6288804897436">KONTAK</a>
          </li>
        </ul>
        
        <div class="validation">
          {{-- <a href="/login">Daftar</a>
          <a href="/register" class="button-secondary">Masuk</a> --}}
          <button onclick="location.href='{{ route('register.index')}}'" class="button-primary">Daftar</button>
          <button onclick="location.href='{{ route('login.index')}}'" class="button-secondary">Masuk</button>
        </div>

      </div>
    </div>
  </nav>

      <!-- Hero Section -->
  <section id="hero">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-md-9 hero-tagline my-auto">
                <h1>Membantu Mengerjakan Laporan  
                Administrasi & Pendataan</h1>
                <p> Kini <span class="fw-bold">Argoinvity</span> hadir untuk membantu anda dalam mengerjakan pelaporan keuangan & pendataan terbaik untukmu dengan sumber  terpercaya.</p>

                <button class="button-lg-primary">Temukan Solusinya</button>
                <a href="#">
                  <img src="assets/img/arrow.png" alt="">
                </a>
            </div>
        </div>

        <img src="assets/img/hero.png" alt="" class="position-absolute end-0 bottom-0 img-hero">
        <img src="assets/img/layer.png" alt="" class="accsent-img h-100 position-absolute top-0 start-0">
    </div> 
  </section>

  <!-- Layanan Section -->
  <section id="service">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <h2>Layanan Kami</h2>
          <span class="sub-title">Argoinvity hadir menjadi solusi bagi para pengusa mitra dibidang argoindustri</span>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-4 text-center">
          <div class="card-layanan">
            <div class="circle-icon position-relative mx-auto">
              <img src="assets/img/book.png" alt="" class="position-absolute top-50 start-50 translate-middle">
            </div>
            <h3 class="mt-4">Artikel</h3>
            <p class="mt-3">Argoinvity kini hadir dengan berbagai artikel,
              yang dilengkapi dengan materi-materi 
              yang berbobot & berkualitas
              </p>
          </div>    
        </div>

        <div class="col-md-4 text-center">
          <div class="card-layanan">
            <div class="circle-icon position-relative mx-auto">
              <img src="assets/img/pendataan.png" alt="" class="position-absolute top-50 start-50 translate-middle">
            </div>
            <h3 class="mt-4">Pendataan</h3>
            <p class="mt-3">Fitur Pendataan hadir dengan beraneka ragam 
              fitur lainnya, seperti pencatatan operasional, 
              bahan baku & hasil produksi
              </p>
          </div>    
        </div>

        <div class="col-md-4 text-center">
          <div class="card-layanan">
            <div class="circle-icon position-relative mx-auto">
              <img src="assets/img/kalkulator.png" alt="" class="position-absolute top-50 start-50 translate-middle">
            </div>
            <h3 class="mt-4">Kalkulator</h3>
            <p class="mt-3">Argoinvity kini hadir dengan fitur kalkulator,
              yang digunakan untuk mempermudah
              mitra dalam menghitung 
              administrasi keuangan
              </p>
          </div>    
        </div>

      </div>
    </div>
  </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="{{ asset('js/homePage.js')}}"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
@endsection