@extends('layouts.app')

@section('title', 'SteamGo — Admin Dashboard')

@section('content')
    @include('pages.dashboard')
    @include('pages.antrian')
    @include('pages.pesanan')
    @include('pages.konfirmasi-booking')
    @include('pages.konfirmasi-pembayaran')
    @include('pages.layanan')
    @include('pages.pelanggan')
    @include('pages.laporan')
    @include('pages.chat')
    @include('pages.pengaturan')
@endsection