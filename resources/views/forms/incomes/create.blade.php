@extends('master')

@section('title', 'Menambah Data Bahan Baku')

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
    {{-- @elseif (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                position: 'top-center',
                footer: '<a href=""></a>'
            })
        </script> --}}
    @endif
</div>

@section('content')
<div class="content">
    <div class="form-container">
        <div class="edit-form col-4">
            <form action="{{ route('products.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Nama Produk: </label>
                    <input type="text" class="form-control" name="name" placeholder="cth: Daun Teh 1kg" required>
                </div>
                <div class="form-group">
                    <label for="total_qty" class="form-label">Jumlah: </label>
                    <input type="number" class="form-control" name="total_qty" placeholder="cth: 2" required>
                </div>
                <div class="form-group">
                    <label for="sold_products" class="form-label">Produk Terjual: </label>
                    <input type="number" class="form-control" name="sold_products" placeholder="cth: 20" required>
                </div>
                <div class="form-group">
                    <label for="price_per_qty" class="form-label">Harga: </label>
                    <input type="number" class="form-control" name="price_per_qty" placeholder="cth: 50000" required>
                </div>
                <button type="submit" class="btn form-button btn-success" name="save-btn">Tambahkan</button>
                <a class="btn btn-danger" href="{{ route('section.production') }}">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection