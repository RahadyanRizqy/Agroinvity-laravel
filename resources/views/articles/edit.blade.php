@extends('master')

@section('title', 'Agroinvity')

@push('style')
    <style>
                body {
            margin: 0;
            padding: 0;
            background-color:  #057455;
        }

        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #263043;
            width: 900px;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 0.5rem;
            box-shadow: 5px 5px 5px 5px #263043;
            flex-direction: column;
        }

        .form-group {
            width: 800px;
            margin: 10px 10px;
        }

        label {
            color: white;
        }
    </style>
@endpush
  
@section('content')     
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<section class="main-container">
    <div class="form-container">
        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="cth: Tanam Pintar" value="{{ $article->title }}" required>
            </div>
            <div class="form-group">
                <label for="article-content">Isi artikel</label>
                <textarea class="form-control" name="text" id="text" rows="15" placeholder="cth: Sebagai seorang petani..." required>{{ $article->text }}</textarea>
            </div>
            <div class="form-group">
                <label for="article-content">Gambar</label>
                <input type="file" name="image" class="form-control" placeholder="image">
                <img src="/image/{{$article->image}}" width="100px">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="save-btn">Perbarui</button>
                <a class="btn btn-danger" href="{{ route('articles.index') }}"> Back</a>
            </div>
        </form>
    </div>
</section>
@endsection