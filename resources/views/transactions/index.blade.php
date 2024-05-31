@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Transactions</h1>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary">Add New Transaction</a>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>User</th>
                <th>Supplier</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->product->name }}</td>
                <td>{{ $transaction->user->name }}</td>
                <td>{{ $transaction->supplier->name ?? 'N/A' }}</td>
                <td>{{ $transaction->type }}</td>
                <td>{{ $transaction->quantity }}</td>
                <td>{{ $transaction->transaction_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
