@extends('layouts.main')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Transaksi - Edit</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- tempat button -->
            </div>
        </div>
        <div class="container mt-4">
            <form action="{{ route('master.data.penjualan.update', $penjualan->id_penjualan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="user_name" class="form-label">User </label>
                    <input type="text" class="form-control" id="user_name" value="{{ $penjualan->user->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="buku" class="form-label">Buku </label>
                    <input type="text" class="form-control" name="buku_id" id="buku_id" value="{{ $penjualan->buku->judul }}" readonly>
                </div>

                <!-- User (tidak perlu dropdown, ambil dari Auth) -->
                <input type="hidden" name="user_id" value="{{ $penjualan->user_id }}">
                <input type="hidden" name="buku_id" value="{{ $penjualan->buku_id }}">

                <div class="mb-3">
                    <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                    <input type="date" class="form-control @error('tanggal_transaksi') is-invalid @enderror"
                        id="tanggal_transaksi" name="tanggal_transaksi" value="{{ old('tanggal_transaksi', $penjualan->tanggal_transaksi) }}" required>
                    @error('tanggal_transaksi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Jumlah Buku -->
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Buku</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah"
                        min="1" value="{{ old('jumlah', $penjualan->jumlah) }}" required oninput="updateTotalHarga()">
                    @error('jumlah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" step="0.01" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga"
                        value="{{ old('harga', $penjualan->harga) }}" readonly required>
                    @error('harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Total Harga -->
                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="number" class="form-control" id="total_harga" name="total_harga" value="{{ $penjualan->jumlah * $penjualan->harga }}" readonly>
                </div>

                <!-- Pembayaran -->
                <div class="mb-3">
                    <label for="pembayaran" class="form-label">Pembayaran</label>
                    <input type="number" class="form-control @error('pembayaran') is-invalid @enderror" id="pembayaran" name="pembayaran"
                        min="0" value="{{ old('pembayaran', $penjualan->pembayaran) }}" required oninput="updateKembalian()">
                    @error('pembayaran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Kembalian -->
                <div class="mb-3">
                    <label for="kembalian" class="form-label">Kembalian</label>
                    <input type="number" class="form-control" id="kembalian" name="kembalian" value="{{ $penjualan->pembayaran - $penjualan->total_harga }}" readonly>
                </div>

                <button type="submit" class="btn btn-primary">Update Penjualan</button>
            </form>
        </div>
    </main>

    <script>
        function updateTotalHarga() {
            const jumlah = document.getElementById('jumlah').value;
            const harga = document.getElementById('harga').value;
            const totalHarga = document.getElementById('total_harga');

            if (jumlah && harga) {
                totalHarga.value = (jumlah * harga).toFixed(2);
            } else {
                totalHarga.value = 0;
            }
            updateKembalian();
        }

        function updateKembalian() {
            const pembayaran = document.getElementById('pembayaran').value;
            const totalHarga = document.getElementById('total_harga').value;
            const kembalian = document.getElementById('kembalian');

            if (pembayaran && totalHarga) {
                kembalian.value = (pembayaran - totalHarga).toFixed(2);
            } else {
                kembalian.value = 0;
            }
        }
    </script>
@endsection
