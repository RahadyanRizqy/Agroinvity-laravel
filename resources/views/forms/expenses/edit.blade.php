@extends('master')

@if ($expense->expense_type_fk == 1)
    @section('title', 'Mengubah Data Bahan Baku')
@elseif ($expense->expense_type_fk == 2)
    @section('title', 'Mengubah Data Operasional')
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
            <form id="registration-form" action="{{ route('expenses.update', $expense->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    @if($expense->expense_type_fk == 1)
                        <label for="name" class="form-label">Nama Bahan Baku</label>
                    @elseif($expense->expense_type_fk == 2)
                        <label for="name" class="form-label">Nama Operasional</label>
                    @else
                        <label for="name" class="form-label">Ini Ngebug</label>
                    @endif
                    <input type="text" class="form-control" name="name" placeholder="cth: Pestisida X" value="{{ $expense->name }}">
                </div>
                <div class="form-group">
                    <label for="quantity" class="form-label">Jumlah: </label>
                    <input type="number" class="form-control" name="quantity" placeholder="cth: 2" value="{{ $expense->quantity }}">
                </div>
                <div class="form-group">
                    <label for="price_per_qty" class="form-label">Harga: </label>
                    <input type="number" class="form-control" name="price_per_qty" placeholder="cth: 55000" value="{{ $expense->price_per_qty }}">
                </div>
                <button type="submit" class="btn form-button btn-success" name="save-btn">Perbarui</button>
                <a class="btn btn-danger" href="{{ route('section.expenses', $expense->expense_type_fk) }}">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection