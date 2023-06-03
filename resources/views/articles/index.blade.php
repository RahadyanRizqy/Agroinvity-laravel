@extends('master')

@section('title', 'Agroinvity')
     
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD with Image Upload Example from scratch - ItSolutionStuff.com</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('articles.create') }}"> Create New article</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Title</th>
            <th>Details</th>
            <th>Waktu Posting</th>
            <th>Action</th>
        </tr>
        @foreach ($articles as $article)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/image/{{ $article->image }}" width="100px"></td>
            <td>{{ $article->title }}</td>
            <td>{{ $article->text }}</td>
            <td>{{ $article->posted_at}} </td>
            <td>
                <form action="{{ route('articles.destroy',$article->id) }}" method="POST">
                    
                    {{-- <a class="btn btn-info" href="{{ route('articles.show', $article->id) }}">Show</a> --}}
                    <a class="btn btn-info" href="{{ route('articles.show', $article->id) }}">Show</a>
                    
      
                    <a class="btn btn-primary" href="{{ route('articles.edit', $article->id) }}">Edit</a>
                    
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {{ $articles->links() }}
</div>
@endsection