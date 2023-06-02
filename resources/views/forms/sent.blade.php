@extends('master')

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
</style>
@endpush

@section('content')
    <div class="content">
        <div class="form-container">
            <h3 class="text-center">Konfirmasi terkirim, silahkan cek email anda!</h3>
        </div>
    </div>
@endsection