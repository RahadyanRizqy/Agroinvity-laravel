@extends('forms.form_layout')

@section('title', 'Agroinvity Corp')

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
        height: 15vh;
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
        margin-bottom: 5px;
    }

    .sweetalert {
        z-index: 100;
    }

    .form-container > h3 {
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
        top: 30vh;
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

    h3 {
        color: white;
    }
</style>
@endpush

@section('content')
<section class="container-fluid">
    <section class="row justify-content-center">
        <section class="col-12 col-sm-4 col-md-4">
        <div class="formcontainer">
            <h3 class="text-center">Konfirmasi terkirim, silahkan cek email anda!</h3>
        </div>
        </section>
    </section>
</section>
@endsection