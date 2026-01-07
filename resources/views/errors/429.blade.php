@extends('bale-dindik::layouts.error')

@section('title', 'Terlalu Banyak Permintaan')

@section('content')
    <x-bale-dindik::error-content code="429" title="Terlalu Banyak Permintaan"
        message="Maaf, Anda telah melakukan terlalu banyak permintaan. Silakan tunggu beberapa saat dan coba lagi." />
@endsection