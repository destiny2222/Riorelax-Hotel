@extends('layouts.main')
@section('content')
<div class="container py-5 text-center">
    <h3>Pay at POS</h3>
    <p>Take the following reference code to an OPay-enabled POS terminal:</p>
    <h2 class="text-warning">{{ $pos['referenceCode'] ?? 'N/A' }}</h2>
    <p class="mt-3">The agent will process your payment instantly.</p>
</div>
@endsection
