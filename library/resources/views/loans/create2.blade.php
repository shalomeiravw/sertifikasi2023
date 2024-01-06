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
    <form action="/loans/create2" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Member Name</label>
            <div class="dropdown">
                <select id="selectMember">
                    <option value="" selected>Select Name</option>
                    @foreach($member as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="loanDate" class="form-label">Loan Date</label>
            <div>
                <input type="date" id="loanDate" name="loan_date">
            </div>
            {{-- <section class="container">
                <form class="row">
                    <div class="col-5">
                        <div class="input-group date" id="datepicker">
                            <input type="text" class="form-control" id="date"/>
                            <span class="input-group-append">
                                <span class="input-group-text bg-light d-block">
                                    <i class="fa-regular fa-calendar"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </form>
            </section> --}}
        </div>
        <div class="mb-3">
            <label for="returnDue" class="form-label">Return Due</label>
            <div>
                <input type="date" id="returnDue" name="due_date" readonly>
            </div>
        </div>      
        {{-- <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="p-3">
                        <label for="exampleInputEmail1" class="form-label">Book Title</label>
                            <select id="selectBook">
                                <option value="" selected>Select Book</option>
                                @foreach($book as $b)
                                    @if ($b->member_id === null)
                                        <option value="{{ $b->id }}">{{ $b->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="submit" name="submit" class="btn btn-primary" value="Add">
                    </div>  
                </div>
                <div class="card-body">
                    <table class="table table-small">
                        @foreach ($loantable as $lb)
                            <tr>
                                <td class="align-middle">
                                    @if(($lb->book)->picture_file)
                                        <img class="img-thumbnail" width="100" src="/uploads/{{ ($lb->book)->picture_file }}" alt="">
                                    @else
                                        <img class="img-thumbnail" width="100" src="/uploads/nopicture.jpg" alt="">
                                    @endif
                                </td>
                                <td class="align-middle">{{ ($lb->book)->title }}</td>
                                <td>
                                    <div class="d-flex justify-content-center" role="group" aria-label="Basic example">
                                        <form action="/loans/create2" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div> --}}
        {{-- <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="p-3">
                        <label for="exampleInputEmail1" class="form-label">Book Title</label>
                        <select id="selectBook" name="selected_books[]">
                            <option value="" selected>Select Book</option>
                            @foreach($book as $b)
                                <option value="{{ $b->id }}">{{ $b->title }}</option>
                            @endforeach
                        </select>
                        <button type="button" id="addBook" class="btn btn-primary">Add Book</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-small">
                        @foreach ($loantable as $lt)
                            <tr>
                                <td class="align-middle">
                                    @if(($lt->book)->picture_file)
                                        <img class="img-thumbnail" width="100" src="/uploads/{{ ($lt->book)->picture_file }}" alt="">
                                    @else
                                        <img class="img-thumbnail" width="100" src="/uploads/nopicture.jpg" alt="">
                                    @endif
                                </td>
                                <td class="align-middle">{{ ($lt->book)->title }}</td>
                                <td>
                                    <div class="d-flex justify-content-center" role="group" aria-label="Basic example">
                                        <form action="{{ route('loans.deleteBook', $lt->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div> --}}
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="p-3">
                        <label for="exampleInputEmail1" class="form-label">Book Title</label>
                        <select id="selectBook" name="selected_books[]" multiple>
                            <option value="" selected>Select Book</option>
                            @foreach($book as $b)
                                <option value="{{ $b->id }}">{{ $b->title }}</option>
                            @endforeach
                        </select>
                        <button type="button" id="addBook" class="btn btn-primary">Add Book</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-small">
                        <tbody>
                            @foreach($loan as $l)
                                <tr>
                                    <td class="align-middle">
                                        @if(($l->book)->picture_file)
                                            <img class="img-thumbnail" width="100" src="/uploads/{{ ($lt->book)->picture_file }}" alt="">
                                        @else
                                            <img class="img-thumbnail" width="100" src="/uploads/nopicture.jpg" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $l->book->title }}</td>
                                    <td>
                                        <form action="{{ route('loans.deleteBook', $l->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        {{-- <button class="btn btn-dark" type="button">+ Book</button> --}}
        <input type="submit" name="submit" class="btn btn-info mt-3 mb-3" value="Add Record">
    </form>
</div>
@endsection