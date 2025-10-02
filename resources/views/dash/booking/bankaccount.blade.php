@extends('layouts.main')
@section('content')
<div class="container py-5">
    <h3>Bank Account Debit</h3>
    <p>Payment will be attempted directly from your bank account.</p>
    <ul class="list-group">
        <li class="list-group-item"><strong>Bank:</strong> {{ $account['bankName'] ?? '' }}</li>
        <li class="list-group-item"><strong>Account Number:</strong> {{ $account['accountNumber'] ?? '' }}</li>
    </ul>
    <p class="mt-3">If required, follow the bank’s OTP prompt on your mobile.</p>
</div>
@endsection
