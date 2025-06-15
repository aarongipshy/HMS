@extends('layouts.app')

@section('content')
<div class="text-center mt-5">
    <h2>សូមស្កេន QR Code ដើម្បីបង់ប្រាក់</h2>
    <p>{{ $qrText }}</p>

    <div class="d-flex justify-content-center mt-4">
        {!! QrCode::size(250)->generate($qrText) !!}
    </div>

    <a href="{{ url('/') }}" class="btn btn-primary mt-4">ត្រលប់ទៅគេហទំព័រ</a>
</div>
@endsection
