@extends('layouts.master')

@section('content')

<div class="container">

    <a class="btn btn-info mb-3 mt-3" href="/loan">+ Loan Record</a>
    <div class="row justify-content-center">
        {{-- <div class="col-md-8"> --}}
            <div class="card">
                <div class="card-header">{{ __('Books') }}</div>
                <div class="card-body">
                    <a class="btn btn-primary" href="/books/create">+ Book</a>
                    <table class="table table-hover">
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Publish Year</th>
                            <th>Synopsis</th>
                            <th>Borrowed by</th>
                        </tr>
                        @foreach ($book as $b)
                            <tr>
                                <td class="align-middle">
                                    @if($b->picture_file)
                                        <img class="img-thumbnail" width="100" src="/uploads/{{ $b->picture_file }}" alt="">
                                    @else
                                        <img class="img-thumbnail" width="100" src="/uploads/nopicture.jpg" alt="">
                                    @endif
                                    {{ $b->title }}
                                </td>
                                <td class="align-middle">{{ $b->author }}</td>
                                <td class="align-middle">{{ $b->genre }}</td>
                                <td class="align-middle">{{ $b->year_publish }}</td>
                                <td class="align-middle">{{ $b->synopsis }}</td>
                                <td class="align-middle">{{ optional($b->member)->name }}</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center" role="group" aria-label="Basic example">
                                        <a class="btn btn-warning" href="/books/{{ $b->id }}/edit">Edit</a>
                                        <form action="/books/{{ $b->id }}" method="POST">
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