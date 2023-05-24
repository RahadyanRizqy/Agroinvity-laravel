@extends('master')

@section('title', 'Artikel {{ $article->title }}')
   
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h1>{{ $article->title }}</h1>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <p>{{ $article->text }}</p>
            </div>
        </div>
        {{-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong>
                <img src="/image/{{ $article->image }}" width="500px">
            </div>
        </div> --}}
    </div>
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('section.article') }}"> Back</a>
            </div>
        </div>
    </div>
</div>
@endsection