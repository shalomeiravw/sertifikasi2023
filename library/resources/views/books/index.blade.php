@extends('layouts.master')

@section('content')

<div class="container">

    <a class="btn btn-info mb-3 mt-3" href="/books/create">+ New Book</a>
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
                                <td class="align-middle col-md-3">{{ $b->synopsis }}</td>
                                <td class="align-middle">{{ optional($b->member)->name }}</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center" role="group" aria-label="Basic example">
                                        <a class="btn btn-warning mr-3" href="/books/{{ $b->id }}/edit">Edit</a>
                                        <form action="/books/{{ $b->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
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