@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Add New Loan Record</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/loans/{{ $loan->id }}" method="POST">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Member Name</label>
            <div class="dropdown">
                <select id="selectMember" name="member_id" required>
                    <option value="{{ $loan->member_id }}" selected>{{ ($loan->member)->name }}</option>
                    @foreach($member as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="loanDate" class="form-label">Loan Date</label>
            <div>
                <input type="date" id="loanDate" name="loan_date" required value="{{ $loan->loan_date }}">
            </div>
        </div>
        <div class="mb-3">
            <label for="returnDue" class="form-label">Return Due</label>
            <div>
                <input type="date" id="returnDue" name="due_date" readonly required value="{{ $loan->due_date }}">
            </div>
        </div>  
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Book Title</label>
            <select id="selectBook" name="book_id" required>
                <option value="{{ $loan->book_id }}" selected>{{ ($loan->book)->title }}</option>
                    @foreach($book as $b)
                        <option value="{{ $b->id }}">{{ $b->title }}</option>
                    @endforeach
            </select>
        </div>  
        
    </div>
        <input type="submit" name="submit" class="btn btn-info mt-3 mb-3" value="Save">
    </form>
</div>

<script>
    document.getElementById('loanDate').addEventListener('change', function() {
        var loanDate = new Date(this.value);
        loanDate.setDate(loanDate.getDate() + 7);
        var formattedDueDate = loanDate.toISOString().substr(0, 10);
        document.getElementById('returnDue').value = formattedDueDate;
    });
</script>
@endsection