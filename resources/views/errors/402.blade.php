@extends('bale-dindik::layouts.error')

@section('title', 'Pembayaran Diperlukan')

@section('content')
    <x-bale-dindik::error-content code="402" title="Pembayaran Diperlukan"
        message="Maaf, Anda perlu melakukan pembayaran untuk mengakses layanan ini." />
@endsection