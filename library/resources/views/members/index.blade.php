@extends('layouts.master')

@section('content')
{{-- <div class="container">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
          </tr>
        </tbody>
      </table>
</div> --}}

<div class="container">
  <div class="d-flex justify-content-between">
    <div class="pb-3">
      <form class="d-flex mt-3" action="/members" method="get">
        <input class="form-control me-1" type="search" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Search a member's name" style="width: 500px;">
        <button class="btn btn-secondary" type="submit">Search</button>
      </form>
    </div>
    <a class="btn btn-info mb-3 mt-3" href="/members/create">+ New Member</a>
  </div>
    <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Members') }}</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                        @foreach ($member as $m)
                            <tr>
                                <td>{{ $m->name }}</td>
                                <td>{{ $m->email }}</td>
                                <td>{{ $m->phone }}</td>
                                <td>
                                    <div class="row">
                                      <div class="col">
                                          <a class="btn btn-warning btn-block" href="/members/{{ $m->id }}/edit">Edit</a>
                                      </div>
                                      <div class="col">
                                          <form action="/members/{{ $m->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this member?');">
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