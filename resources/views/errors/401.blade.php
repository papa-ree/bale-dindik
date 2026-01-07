@extends('bale-dindik::layouts.error')

@section('title', 'Tidak Terautentikasi')

@section('content')
    <x-bale-dindik::error-content code="401" title="Tidak Terautentikasi"
        message="Maaf, Anda harus login terlebih dahulu untuk mengakses halaman ini." />
@endsection