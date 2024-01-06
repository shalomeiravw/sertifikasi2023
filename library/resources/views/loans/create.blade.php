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
    <form action="/loans" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Member Name</label>
            <div class="dropdown">
                <select id="selectMember">
                    <option value="" selected>Select Name</option>
                    @foreach($member as $m)
                        <option value="member">{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Book Title</label>
            <div class="dropdown">
                <select id="selectBook">
                    <option value="" selected>Select Book</option>
                    @foreach($book as $b)
                        @if ($b->member_id === null)
                            <option value="book">{{ $b->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <button class="btn btn-dark" type="button">+ Book</button>
        {{--<div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Member Name</label>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMemberButton" data-bs-toggle="dropdown" aria-expanded="false">
                Select Name
                </button>
                <ul class="dropdown-menu"
                    aria-labelledby="dropdownMemberButton">
                    <input type="text"
                    class="form-control border-0 border-bottom 
                    shadow-none mb-2" placeholder="Search..."
                        oninput="handleInput()">
                </ul>
                {{-- <ul class="dropdown-menu" id="selected" aria-labelledby="dropdownMember">
                    @foreach($member as $m)
                        <li><a class="dropdown-item" href="">{{ $m->name }}</a></li>
                    @endforeach
                </ul> --}}
            {{--</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Book Title</label>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownBookButton" data-bs-toggle="dropdown" aria-expanded="false">
                Select Book
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownBook">
                    @foreach($book as $b)
                        @if ($b->member_id === null)
                            <li><a class="dropdown-item" href="">{{ $b->title }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>--}}
        {{-- <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Author</label>
            <input type="string" name="author" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div> --}}
        <input type="submit" name="submit" class="btn btn-info" value="Add">
    </form>
</div>
{{-- <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script> --}}

@endsection