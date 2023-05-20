@extends('main')

@section('title', 'Dashboard')

@push('style')
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush
<p>
  Berhasil masuk dashboard {{ $id }}
</p>

{{-- Digunakan untuk Expenses --}}