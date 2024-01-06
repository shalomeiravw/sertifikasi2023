@extends('layouts.master')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between">
        <div class="pb-3">
            <form class="d-flex mt-3" action="/loans" method="get">
            <input class="form-control me-1" type="search" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Search a member's name" style="width: 500px;">
            <button class="btn btn-secondary" type="submit">Search</button>
            </form>
        </div>
        <a class="btn btn-info mb-3 mt-3" href="/loans/create3">+ Loan</a>
    </div>
    <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Loan Record') }}</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Book Title</th>
                            <th>Member Name</th>
                            <th>Borrow Date</th>
                            <th>Date Return Due</th>
                            <th>Return Date</th>
                        </tr>
                        @foreach ($loan as $l)
                            <tr @if($l->due_date <= now()->format('Y-m-d') && $l->return_date === null) class="table-danger" @endif>
                                <td class="align-middle">{{ ($l->book)->title }}</td>
                                <td class="align-middle">{{ ($l->member)->name }}</td>
                                <td class="align-middle">{{ $l->loan_date }}</td>
                                <td class="align-middle">{{ $l->due_date }}</td>
                                <td class="align-middle col-md-3">{{ $l->return_date }}</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center" role="group" aria-label="Basic example">
                                        <a class="btn btn-warning mr-3" href="/loans/{{ $l->id }}/edit">Edit</a>
                                        <form action="/loans/{{ $l->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this loan?');">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    </div>
                                    @if ($l->return_date === null)
                                        <div class="d-flex justify-content-center" role="group" aria-label="Basic example" style="margin-top: 10px">
                                            <form action="/loans/{{ $l->id }}/return" method="POST" onsubmit="return confirm('Are you sure you want to mark this book as returned?');">
                                                @csrf
                                                <button type="submit" class="btn btn-success mr-3">Returned</button>
                                            </form>
                                        </div>
                                    @endif
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