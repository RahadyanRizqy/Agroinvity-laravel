@extends('articles.layout')

@section('title', 'Buat Artikel')

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
        top: 1vh;
        padding: 50px;
        border-radius: 10px;
        box-shadow: 0px 5px 50px #000;
        color:#1E1E1E;
        font-size:14px;
        font-weight:bold;
        /* width: 50%; */
        width: 1000px;

        background: #004b2db8;

    }
    .sweetalert {
        z-index: 100;
    }

    label {
        color: white;
    }
    
    strong {
        color: white;
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
            text: '{!! $errors->first() !!}',
            position: 'top-center',
            footer: '<a href=""></a>'
        })
    </script>
    @endif
</div>

@section('content')     
<section class="container-fluid">
    <section class="row justify-content-center">
            <form class="formcontainer" action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title" >Judul</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="cth: Tanam Pintar" value="{{ old('title')}}">
                </div>
                <div class="form-group">
                    <label for="article-content">Isi artikel</label>
                    <textarea class="form-control" name="text" id="text" rows="15" placeholder="cth: Sebagai seorang petani...">{{ old('text') }}</textarea>
                </div>
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control" placeholder="image">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="save-btn">Tambahkan</button>
                    <a class="btn btn-danger" href="{{ route('articles.index') }}">Kembali</a>
                </div>
            </form>
        </section>
</section>
@endsection