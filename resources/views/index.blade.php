@extends('layouts.app')

@section('content')

    {{-- ══ PAGE: DASHBOARD ══ --}}
    @include('pages.dashboard')

    {{-- ══ PAGE: ANTRIAN ══ --}}
    @include('pages.antrian')

    {{-- ══ PAGE: PESANAN ══ --}}
    @include('pages.pesanan')

    {{-- ══ PAGE: LAYANAN ══ --}}
    @include('pages.layanan')

    {{-- ══ PAGE: PELANGGAN ══ --}}
    @include('pages.pelanggan')

    {{-- ══ PAGE: LAPORAN ══ --}}
    @include('pages.laporan')

    {{-- ══ PAGE: PENGATURAN ══ --}}
    @include('pages.pengaturan')

    {{-- ══ PAGE: CHAT ══ --}}
    @include('pages.chat')

@endsection