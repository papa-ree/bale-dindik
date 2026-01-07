@extends('bale-dindik::layouts.error')

@section('title', 'Akses Ditolak')

@section('content')
    <x-bale-dindik::error-content code="403" title="Akses Ditolak"
        message="Maaf, Anda tidak memiliki izin untuk mengakses halaman ini." />
@endsection