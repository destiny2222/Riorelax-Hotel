@extends('layouts.main')
@section('content')
<div class="container py-5 text-center">
    <h3>Redirecting to OPay Card Payment...</h3>
    <p>If you are not redirected automatically, <a href="{{ $cashierUrl }}">click here</a>.</p>
</div>
<script> window.location.href = "{{ $cashierUrl }}"; </script>
@endsection
