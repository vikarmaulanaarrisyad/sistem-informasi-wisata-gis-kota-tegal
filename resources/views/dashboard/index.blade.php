@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    @parent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <x-card>
                <img src="{{ asset('image/kota-tegal.png') }}" alt="" width="25%" height="25%"
                    style=" display: block; margin-left: auto; margin-right: auto;">
                <h2 class="text-center text-bold mt-3">Selamat Datang Di Web-GIS Kota Tegal</h2>
            </x-card>
        </div>
    </div>
@endsection
