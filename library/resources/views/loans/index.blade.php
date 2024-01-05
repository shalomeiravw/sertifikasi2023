@extends('layouts.master')

@section('content')

<div class="container">

    <a class="btn btn-info mb-3 mt-3" href="/loans/create">+ Loan</a>
    <div class="row justify-content-center">
        {{-- <div class="col-md-8"> --}}
            <div class="card">
                <div class="card-header">{{ __('Loan Record') }}</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Book Title</th>
                            <th>Member Name</th>
                            <th>Borrow Date</th>
                            <th>Date Return Due</th>
                            <th>Return Date</th>
                        </tr>
                        @foreach ($loan as $l)
                            <tr>
                                <td class="align-middle">{{ ($l->book)->name }}</td>
                                <td class="align-middle">{{ ($l->member)->name }}</td>
                                <td class="align-middle">{{ $l->loan_date }}</td>
                                <td class="align-middle">{{ $l->due_date }}</td>
                                <td class="align-middle col-md-3">{{ $l->return_date }}</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center" role="group" aria-label="Basic example">
                                        <a class="btn btn-warning mr-3" href="/books/{{ $l->id }}/edit">Edit</a>
                                        <form action="/books/{{ $l->id }}" method="POST">
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
        {{-- </div> --}}
    </div>
</div>
@endsection