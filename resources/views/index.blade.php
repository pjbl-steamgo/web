@extends('layouts.app')

@section('title', 'SteamGo — Admin Dashboard')

@section('content')
    @switch($initPage ?? 'dashboard')
        @case('dashboard')
            @include('pages.dashboard')
            @break

        @case('antrian-jadwal')
                @include('pages.antrian') 
                @break

        @case('pesanan')
            @include('pages.pesanan')
            @break

        @case('konfirmasi-booking')
            @include('pages.konfirmasi-booking')
            @break

        @case('konfirmasi-pembayaran')
            @include('pages.konfirmasi-pembayaran')
            @break

        @case('layanan')
            @include('pages.layanan')
            @break

        @case('pelanggan')
            @include('pages.pelanggan')
            @break

        @case('laporan')
            @include('pages.laporan')
            @break

        @case('chat')
            @include('pages.chat')
            @break

        @case('pengaturan')
            @include('pages.pengaturan')
            @break

        @default
            @include('pages.dashboard')
    @endswitch
@endsection