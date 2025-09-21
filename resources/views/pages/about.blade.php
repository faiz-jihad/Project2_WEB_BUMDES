@extends('layouts.master')

@section('content')
    <div class="container mt-3">
        <h1>selamat Datang di Halaman About</h1>
        <div class="card">
            <div class="card-body">
               {{ $nama }}
                <br>
                {{ $email }}
                <br>
                {{ $alamat }}
                <br>
                {{ $pekerjaan }}
                <br>
                {{ $umur }}
                <br>
                {{ $hobi }}
            </div>
        </div>

    </div>
@endsection
