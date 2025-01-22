@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Transaksi - Buat</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- tempat button -->
            </div>
        </div>
        <div class="container mt-4">
            <form action="{{ route('master.data.penjualan.store') }}" method="POST">
                @csrf

                <!-- User (tidak perlu dropdown, ambil dari Auth) -->
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="mb-3">
                    <label for="user_name" class="form-label">User </label>
                    <input type="text" class="form-control" id="user_name" value="{{ $user->name }}" readonly>
                </div>

                <!-- Buku -->
                <div class="mb-3">
                    <label for="buku_id" class="form-label">Buku</label>
                    <select class="form-select @error('buku_id') is-invalid @enderror" id="buku_id" name="buku_id"
                        required onchange="updateHarga()">
                        <option selected disabled>Pilih Buku</option>
                        @foreach ($bukus as $buku)
                            <option value="{{ $buku->id_buku }}" data-harga="{{ $buku->harga }}">{{ $buku->judul }} - Rp {{ number_format($buku->harga, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                    @error('buku_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Tanggal Transaksi -->
                <div class="mb-3">
                    <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                    <input type="date" class="form-control @error('tanggal_transaksi') is-invalid @enderror"
                        id="tanggal_transaksi" name="tanggal_transaksi" required>
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
                        min="1" required oninput="updateTotalHarga()">
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
                        readonly required>
                    @error('harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Total Harga -->
                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="number" class="form-control" id="total_harga" name="total_harga" readonly>
                </div>

                <!-- Pembayaran -->
                <div class="mb-3">
                    <label for="pembayaran" class="form-label">Pembayaran</label>
                    <input type="number" class="form-control @error('pembayaran') is-invalid @enderror" id="pembayaran" name="pembayaran"
                        min="0" required oninput="updateKembalian()">
                    @error('pembayaran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Kembalian -->
                <div class="mb-3">
                    <label for="kembalian" class="form-label">Kembalian</label>
                    <input type="number" class="form-control" id="kembalian" name="kembalian" readonly>
                </div>

                <button type="submit" class="btn btn-primary">Tambah Penjualan</button>
            </form>
        </div>
    </main>

    <script>
        function updateHarga() {
            const bukuSelect = document.getElementById('buku_id');
            const hargaInput = document.getElementById('harga');
            const selectedOption = bukuSelect.options[bukuSelect.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');

            if (harga) {
                hargaInput.value = parseFloat(harga).toFixed(2);
            } else {
                hargaInput.value = '';
            }
            updateTotalHarga();
        }

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
