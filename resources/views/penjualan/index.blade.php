@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Transaksi</h1>
        @if ($user->role == 'pengguna')

            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- Tombol Tambah menggunakan tag a -->
                <a href="{{ route('master.data.penjualan.create') }}" class="btn btn-primary" role="button">Tambah
                    Penjualan</a>
            </div>
        @else
        @endif
    </div>
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-lg p-4 rounded d-flex align-items-center position-relative"
                role="alert"
                style="background: linear-gradient(135deg, #4caf50, #81c784); color: #fff; border: none; animation: slideIn 0.8s ease-out;">
                <i class="bi bi-emoji-smile-fill me-4"
                    style="font-size: 2rem; animation: heartBeat 1.2s infinite; margin-top: -5px; margin-left: -10px;"></i>
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

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-lg p-4 rounded d-flex align-items-center position-relative"
                role="alert"
                style="background: linear-gradient(135deg, #f44336, #e57373); color: #fff; border: none; animation: wobble 0.6s ease-in-out;">
                <i class="bi bi-emoji-dizzy-fill me-4"
                    style="font-size: 2rem; animation: shakeX 1.5s infinite; margin-top: -5px; margin-left: -10px;"></i>
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
        <!-- Tabel Daftar Penjualan -->
        <table class="table table-striped">
            <thead>
                <tr>
                    @if ($user->role == 'pengguna')
                    @else
                        <th scope="col">Aksi</th>
                    @endif
                    <th scope="col">User</th>
                    <th scope="col">Buku</th>
                    <th scope="col">Tanggal Transaksi</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Pembayaran</th>
                    <th scope="col">Kembalian</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan as $penjualan)
                    <tr>
                    @if ($user->role == 'pengguna')
                    @else
                        <td>
                            <a href="{{ route('master.data.penjualan.edit', $penjualan->id_penjualan) }}"
                                class="btn btn-sm btn-outline-secondary">
                                Edit
                            </a>
                        </td>
                        @endif
                        <td>{{ $penjualan->user->name }}</td>
                        <td>
                            @if ($penjualan->buku)
                                {{ $penjualan->buku->judul }}
                            @else
                                <span class="text-danger">Buku telah dihapus</span>
                            @endif
                        </td>
                        <td>{{ $penjualan->tanggal_transaksi }}</td>
                        <td>{{ $penjualan->jumlah }}</td>
                        <td>Rp {{ number_format($penjualan->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($penjualan->pembayaran, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}</td>
                        <td>
                        @if ($user->role == 'pengguna')
                                @if ($penjualan->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-success">Sukses</span>
                                @endif
                            @else
                                @if ($penjualan->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-success">Sukses</span>
                                @endif
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