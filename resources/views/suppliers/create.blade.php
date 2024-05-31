@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Supplier</h1>
    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="contact_info">Contact Info</label>
            <textarea class="form-control" id="contact_info" name="contact_info"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Supplier</button>
    </form>
</div>
@endsection
