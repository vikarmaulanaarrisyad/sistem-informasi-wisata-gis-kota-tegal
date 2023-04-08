@extends('layouts.app')

@section('title', 'Detail Wisata');

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('place.index') }}"> Wisata</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-9">
            <x-card>
                <table class="table table-bordered-0">
                    <tr>
                        <th>Nama</th>
                        <td>:</td>
                        <td>{{ $place->name }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>:</td>
                        <td>{{ $place->category->name }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>:</td>
                        <td>{!! $place->description !!}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>:</td>
                        <td>{!! $place->address !!}</td>
                    </tr>
                    <tr>
                        <th>Kecamatan</th>
                        <td>:</td>
                        <td>{{ $place->district }}</td>
                    </tr>
                    <tr>
                        <th>Desa / Kelurahan</th>
                        <td>:</td>
                        <td>{{ $place->village }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Telepon</th>
                        <td>:</td>
                        <td>{{ $place->phone }}</td>
                    </tr>
                    <tr>
                        <th>Website</th>
                        <td>:</td>
                        <td><a href="{{ $place->website }}">{{ $place->website }}</a></td>
                    </tr>
                    <tr>
                        <th>Latitude Longitude</th>
                        <td>:</td>
                        <td>{{ $place->location }}</td>
                    </tr>
                </table>
            </x-card>
        </div>
        <div class="col-md-3">
            <x-card>
                <img src="{{ Storage::url($place->image) }}" alt="image"
                    style="margin-left: auto;margin-right: auto;display: block;" class="img-thumbnail" width="100%"
                    height="100%">
            </x-card>
        </div>
    </div>
@endsection
