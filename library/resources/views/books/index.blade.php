@extends('layouts.master')

@section('content')

<div class="container">

    <a class="btn btn-info" href="/loan">+ Loan Record</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Books') }}</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="/books/create">+ Book</a>
                    <table class="table table-hover">
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Borrowed by</th>
                        </tr>
                        @foreach ($book as $b)
                            <tr>
                                <td>
                                    @if($b->null)
                                    <img class="img-thumbnail" width="150" src="public/nopicture.jpg" alt="">
                                    @endif
                                    <img class="img-thumbnail" width="150" src="/uploads/{{ $b->picture_file }}" alt="">
                                    {{ $b->title }}
                                </td>
                                <td>{{ $b->author }}</td>
                                <td>{{ $b->genre }}</td>
                                <td>{{ optional($b->member)->name }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-warning" href="/books/{{ $b->id }}/edit">Edit</a>
                                        <form action="/books/{{ $b->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    </div>
                                    {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">
                                        Loan
                                    </button> --}}
                                    {{-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="/books" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Loan Book To</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="borrowedBy" class="form-label">Borrowed by</label>
                                                            <select name="borrowed_by" id="borrowedBy" class="form-select select2">
                                                                @foreach($member as $m)
                                                                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> --}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection