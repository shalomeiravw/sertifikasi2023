@extends('layouts.master')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between">
        <div class="pb-3">
            <form class="d-flex mt-3" action="/books" method="get">
            <input class="form-control me-1" type="search" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Search a title, author, genre, or publication year" style="width: 500px;">
            <button class="btn btn-secondary" type="submit">Search</button>
            </form>
        </div>
        <a class="btn btn-info mb-3 mt-3" href="/books/create">+ New Book</a>
    </div>
    <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Books') }}</div>
                <div class="card-body">
                    <table class="table">
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
                                <td class="align-middle col-md-2">{{ $b->synopsis }}</td>
                                <td class="align-middle">{{ optional($b->member)->name }}</td>
                                <td class="align-middle">
                                    <div class="row">
                                        <div class="col">
                                            <a class="btn btn-warning btn-block" href="/books/{{ $b->id }}/edit">Edit</a>
                                        </div>
                                        <div class="col">
                                            <form action="/books/{{ $b->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this member?');">
                                                @csrf
                                                @method('delete')
                                                <input type="submit" class="btn btn-danger btn-block" value="Delete">
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
    </div>
</div>
@endsection