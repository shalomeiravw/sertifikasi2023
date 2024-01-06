@extends('layouts.master')

@section('content')
<div class="row p-3">
    @foreach($book as $b)
        <div class="col-md-4">
            <div class="card mb-3 mt-5" style="max-width: 500px;">
                <div class="row g-0">
                <div class="col-md-4">
                    @if($b->picture_file)
                        <img class="img-thumbnail" width="150" src="/uploads/{{ $b->picture_file }}" alt="">
                    @else
                        <img class="img-thumbnail" width="150" src="/uploads/nopicture.jpg" alt="">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <h5 class="card-title">{{ $b->title }}</h5>
                    <p class="card-text">{{ $b->author }}</p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection