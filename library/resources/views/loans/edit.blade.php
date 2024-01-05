@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Book</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/books/{{ $book->id }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="string" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $book->title }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Author</label>
            <input type="string" name="author" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $book->author }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Genre</label>
            <input type="string" name="genre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $book->genre }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Year Published</label>
            <input type="integer" name="year_publish" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $book->year_publish }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Synopsis</label>
            <textarea type="text" name="synopsis" class="form-control" rows="10" id="exampleInputEmail1" aria-describedby="emailHelp">{{ $book->synopsis }}</textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1">Picture</label>
            <input type="file" name="picture_file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" accept="image/*">
        </div>
        <input type="submit" name="submit" class="btn btn-info" value="Save">
    </form>
</div>

@endsection