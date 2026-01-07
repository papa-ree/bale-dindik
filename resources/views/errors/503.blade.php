@extends('bale-dindik::layouts.error')

@section('title', 'Layanan Tidak Tersedia')

@section('content')
    <x-bale-dindik::error-content code="503" title="Layanan Tidak Tersedia"
        message="Maaf, layanan sedang dalam pemeliharaan. Silakan kembali beberapa saat lagi." />
@endsection