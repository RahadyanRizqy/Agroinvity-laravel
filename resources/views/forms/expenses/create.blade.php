@extends('master')

@if ($type_id == 1)
    @section('title', 'Menambah Data Bahan Baku')
@elseif ($type_id == 2)
    @section('title', 'Menambah Data Operasional')
@endif

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

    .sweetalert {
        z-index: 100;
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
            text: '{{ $errors->first() }}',
            position: 'top-center',
            footer: '<a href=""></a>'
        })
    </script>
    @endif
</div>

@section('content')
<div class="content">
    <div class="form-container">
        <div class="edit-form col-4">
            <form id="registration-form" action="{{ route('expenses.store', ['type_id' => $type_id])}}" method="post">
                @csrf
                <div class="form-group">
                    @if($type_id == 1)
                        <label for="name" class="form-label">Nama Bahan Baku</label>
                    @elseif($type_id == 2)
                        <label for="name" class="form-label">Nama Operasional</label>
                    @else
                        <label for="name" class="form-label">Ini Ngebug</label>
                    @endif
                    <input type="text" class="form-control" name="name" placeholder="cth: Pestisida X" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="quantity" class="form-label">Jumlah: </label>
                    <input type="number" class="form-control" name="quantity" placeholder="cth: 2" value="{{ old('quantity') }}">
                </div>
                <div class="form-group">
                    <label for="price_per_qty" class="form-label">Harga: </label>
                    <input type="number" class="form-control" name="price_per_qty" placeholder="cth: 55000" value="{{ old('price_per_qty') }}">
                </div>
                <button type="submit" class="btn form-button btn-success" name="save-btn">Tambahkan</button>
                <a class="btn btn-danger" href="{{ route('section.expenses', $type_id) }}">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection