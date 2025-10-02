@extends('layouts.main')
@section('content')
<div class="container py-5 text-center">
    <h3>Redirecting to OPay Wallet...</h3>
    <p>Please approve the payment in your OPay App.</p>
    <p>If not redirected, <a href="{{ $cashierUrl }}">click here</a>.</p>
</div>
<script> window.location.href = "{{ $cashierUrl }}"; </script>
@endsection
