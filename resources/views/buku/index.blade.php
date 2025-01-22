@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Buku</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <!-- Tombol Tambah menggunakan tag a -->
            <a href="{{ route('master.data.buku.create') }}" class="btn btn-primary" role="button">Tambah</a>
        </div>
    </div>
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-lg p-4 rounded d-flex align-items-center position-relative"
                role="alert"
                style="background: linear-gradient(135deg, #4caf50, #81c784); color: #fff; border: none; animation: slideIn 0.8s ease-out;">
                <i class="bi bi-emoji-smile-fill me-4" style="font-size: 2rem; animation: heartBeat 1.2s infinite;"></i>
                <div>
                    <h5 class="mb-1 fw-bold" style="text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">Sukses!</h5>
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"
                    style="background: none; border: none; color: #fff; font-size: 1.2rem;"></button>
                <div class="position-absolute end-0 top-0 pe-3 pt-2"
                    style="opacity: 0.8; font-size: 4rem; color: rgba(255, 255, 255, 0.1);">
                    🌟
                </div>
            </div>
        @endif


        <!-- Pesan Error -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-lg p-4 rounded d-flex align-items-center position-relative"
                role="alert"
                style="background: linear-gradient(135deg, #f44336, #e57373); color: #fff; border: none; animation: wobble 0.6s ease-in-out;">
                <i class="bi bi-emoji-dizzy-fill me-4" style="font-size: 2rem; animation: shakeX 1.5s infinite;"></i>
                <div>
                    <h5 class="mb-1 fw-bold" style="text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">Ups, Ada Masalah!</h5>
                    <p class="mb-0">{{ session('error') }}</p>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"
                    style="background: none; border: none; color: #fff; font-size: 1.2rem;"></button>
                <div class="position-absolute end-0 top-0 pe-3 pt-2"
                    style="opacity: 0.8; font-size: 4rem; color: rgba(255, 255, 255, 0.1);">
                    💔
                </div>
            </div>
        @endif


        <style>
            @keyframes slideIn {
                0% {
                    transform: translateY(-50%);
                    opacity: 0;
                }

                100% {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            @keyframes heartBeat {

                0%,
                100% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.1);
                }
            }

            @keyframes shakeX {

                0%,
                100% {
                    transform: translateX(0);
                }

                25%,
                75% {
                    transform: translateX(-10px);
                }

                50% {
                    transform: translateX(10px);
                }
            }

            @keyframes wobble {

                0%,
                100% {
                    transform: rotate(0deg);
                }

                25% {
                    transform: rotate(-3deg);
                }

                75% {
                    transform: rotate(3deg);
                }
            }
        </style>

        <!-- Tabel Daftar Buku -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Aksi</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Status</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($bukus as $buku)
                    <tr>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="{{ route('master.data.buku.edit', $buku->id_buku) }}"
                                class="btn btn-sm btn-outline-secondary">
                                Edit
                            </a>
                            <!-- Tombol Hapus -->
                            <form action="{{ route('master.data.buku.destroy', $buku->id_buku) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                    Hapus
                                </button>
                            </form>
                            @if (Auth::check() && Auth::user()->role === 'pengguna')
                                <!-- Cek apakah pengguna adalah 'pengguna' -->
                                <!-- Tombol Pinjam -->
                                <a href="{{ route('master.data.peminjaman.create', ['buku_id' => $buku->id_buku]) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    Pinjam
                                </a>
                            @endif
                        </td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->kategori->nama }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ $buku->harga }}</td>
                        <td>
                            @if ($buku->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Non-Aktif</span>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection

{{-- untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
@endsection