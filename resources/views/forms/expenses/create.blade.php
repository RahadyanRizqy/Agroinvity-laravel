@extends('forms/form_layout')

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
        top: 18vh;
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
<section class="container-fluid">
    <section class="row justify-content-center">
        <section class="col-12 col-sm-4 col-md-4">
            <form class="formcontainer" action="{{ route('expenses.store', ['type_id' => $type_id])}}" method="post">
                @csrf
                <div class="mb-3">
                @if($type_id == 1)
                    <label for="name" class="form-label">Nama Bahan Baku</label>
                    <input type="text" class="form-control" name="name" placeholder="cth: Pestisida X" id="inputNama" value="{{ old('name') }}">
                @elseif($type_id == 2)
                    <label for="name" class="form-label">Nama Operasional</label>
                    <input type="text" class="form-control" name="name" placeholder="cth: Kompor Wow" id="inputNama" value="{{ old('name') }}">
                @else
                    <label for="name" class="form-label">Ini Ngebug</label>
                    <input type="text" class="form-control" name="name" placeholder="cth: Pestisida X" id="inputNama" value="{{ old('name') }}">
                @endif
                </div>
                <div class="mb-3">
                  <label for="inputJumlah" class="form-label">Jumlah</label>
                  <input type="number" class="form-control" name="quantity" placeholder="cth: 2" id="inputJumlah" value="{{ old('quantity') }}">
                </div>
                <div class="mb-3">
                  <label for="inputHarga" class="form-label">Harga</label>
                  <input type="number" class="form-control" name="price_per_qty" placeholder="cth: 55000" id="inputHarga" value="{{ old('price_per_qty') }}">
                </div>
                <button type="submit" class="btn form-button btn-success" name="save-btn">Tambahkan</button>
                <a class="btn btn-danger" href="{{ route('section.expenses', $type_id) }}">Batal</a>
              </form>
        </section>
    </section>
</section>

{{-- <div class="content">
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
</div> --}}
@endsection