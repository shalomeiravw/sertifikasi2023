@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Add New Loan Record</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/loans" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Member Name</label>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Select Name
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach({{ ($l->member)->id }})
                        <li><a class="dropdown-item" href="">{{ ($l->member)->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Book Title</label>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Select Book
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach({{ ($l->book)->id }})
                        <li><a class="dropdown-item" href="">{{ ($l->book)->title }}</a></li>
                    @endforeach
                </ul>
            </div>
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
        <input type="submit" name="submit" class="btn btn-info" value="Add">
    </form>
</div>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

@endsection