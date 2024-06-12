<!-- resources/views/landing_page/index.blade.php -->

@extends('landing_page.layout')

@section('title', 'MARSOSE - Citizen\'s Report Site')

@section('content')
    <!-- ======= About Section ======= -->
    @include('landing_page.about')

    <!-- ======= Jenis Laporan ======= -->
    @include('landing_page.jenis_laporan')

    <!-- ======= Laporan Section ======= -->
    @include('landing_page.laporan')

    <!-- ======= Pricing Section ======= -->
    @include('landing_page.surat')

    <!-- ======= Galery Section ======= -->
    @include('landing_page.galery')

    <!-- ======= Team Section ======= -->
    @include('landing_page.team')

    <!-- ======= Support Section ======= -->
    @include('landing_page.support')

    <!-- ======= Contact Section ======= -->
    @include('landing_page.contact')
@endsection
