@extends('layouts.master')

@section('content')

<div class="container">

    <a class="btn btn-info mb-3 mt-3" href="/loans/create3">+ Loan</a>
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
                            <tr>
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