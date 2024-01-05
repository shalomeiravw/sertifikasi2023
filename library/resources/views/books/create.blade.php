@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Add New Book</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/books" method="POST" enctype="multipart/form-data>
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="string" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Author</label>
            <input type="string" name="author" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Genre</label>
            <input type="string" name="genre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Year Published</label>
            <input type="integer" name="year_publish" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Synopsis</label>
            <textarea type="text" name="synopsis" class="form-control" rows="10" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1">Picture</label>
            <input type="file" name="picture_file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" accept="image/*">
        </div>
        {{-- <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Borrowed by</label>
                <select class="form-select select2">
                    @foreach($member as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                </select>
            <input type="text" name="genre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div> --}}
        <input type="submit" name="submit" class="btn btn-info" value="Add">
    </form>
</div>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

@endsection