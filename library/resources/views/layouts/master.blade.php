<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="NEW_INTEGRITY_VALUE" crossorigin="anonymous"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.9.0/dist/js/bootstrap.min.js"></script> --}}


    <title>Document</title>
</head>
<body>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/">Library</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                    <a class="nav-link {{ request()->is('books') ? 'active' : '' }}" href="/books">Books <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link {{ request()->is('members') ? 'active' : '' }}" href="/members">Members</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link {{ request()->is('loans') ? 'active' : '' }}" href="/loans">Loans</a>
                    </li>
                </ul>
                <ul class="navbar-nav justify-content-end" style="width: 100%">
                    <li class="nav-item d-flex">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a href="{{ route('logout') }}" class="nav-link text-body" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <span class="d-sm-inline d-none">Log Out</span>
                        </a>
                    </li>
                </ul>
                </div>
            </nav>
            @if(session()->has('success'))
                <div class=" row">
                <div class="col-12">
                    <div class="alert alert-success">{{ session('success') }}</div>
                </div>
                </div>
            @endif
            @yield('content')
        </div>
    </body>
</html>