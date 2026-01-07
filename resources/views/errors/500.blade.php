@extends('bale-dindik::layouts.error')

@section('title', 'Kesalahan Server')

@section('content')
    <x-bale-dindik::error-content code="500" title="Kesalahan Server"
        message="Maaf, terjadi kesalahan pada server kami. Tim kami sedang bekerja untuk memperbaikinya." />
@endsection