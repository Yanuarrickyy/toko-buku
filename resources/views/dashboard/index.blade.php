@extends('layouts.main')
{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
{{-- <style>
     body {
            height: 100%;
            background-color: rgb(45, 240, 240);
        }
</style> --}}
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard Buku</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- tempat button -->
                
            </div>
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($bukus as $buku)
                    <div class="col">
                        <div class="card shadow-sm">
                            <!-- Gambar dari database -->
                            <img src="{{ asset($buku->cover) }}" class="card-img-top" alt="Thumbnail Buku" />

                            <div class="card-body">
                                <!-- Judul Buku dan Status -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">{{ $buku->judul }}</h5>
                                    <!-- Menampilkan status -->
                                    <span class="badge {{ $buku->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($buku->status) }}
                                    </span>
                                </div>

                                <!-- Deskripsi Buku -->
                                <p class="card-text">
                                    {{ $buku->deskripsi }}
                                </p>

                                <!-- Penulis -->
                                <p class="card-text">
                                    <strong>Penulis:</strong> {{ $buku->penulis }}
                                </p>

                                <!-- Kategori -->
                                <p class="card-text">
                                    <strong>Kategori:</strong> {{ $buku->kategori->nama }}
                                </p>

                                <!-- Harga -->
                                <p class="card-text">
                                    <strong>Harga:</strong> Rp{{ number_format($buku->harga, 2, ',', '.') }}
                                </p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <small
                                        class="text-body-secondary">{{ Carbon\Carbon::parse($buku->created_at)->format('j F, Y') }}</small>
                                    @if (Auth::check() && Auth::user()->role === 'pengguna')
                                        <!-- Cek apakah pengguna adalah 'pengguna' -->
                                        <a href="{{ route('master.data.penjualan.create', $buku->id_buku) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            Beli
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection

{{-- untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
@endsection
