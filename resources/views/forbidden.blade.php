@extends('master')

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
        
        p {
            
        }
    </style>
@endpush

@section('title', 'Akses Terlarang')

@section('content')
    <h1>
        403 | AKSES TERLARANG
    </h1>
    {{-- <span> {{ dd(Auth::user()->load('accountType')->accountType->account_type_name) }}</span> --}}
    {{-- RELATION N+1 SOLVED --}}
@endsection