@extends('layouts.main')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Transaksi - Edit</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <!-- tempat button -->
        </div>
    </div>
    <div class="container mt-4">
        <form action="{{ route('master.data.penjualan.update', $penjualan->id_penjualan) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="user_id" value="{{ $penjualan->user_id }}">

            <div class="mb-3">
                <label for="user_name" class="form-label">User</label>
                <input type="text" class="form-control" id="user_name" value="{{ $penjualan->user->name }}" readonly>
            </div>

            <!-- Buku -->
            <div class="mb-3">
    <label for="buku_id" class="form-label">Buku (Ubah)</label>
    <input type="checkbox" id="ubah_buku" onchange="toggleBukuSelect()">
    <select class="form-select" id="buku_id" name="buku_id" onchange="updateHarga()">
        <option selected disabled>Pilih Buku</option>
        @foreach ($bukus as $buku)
            <option value="{{ $buku->id_buku }}" data-harga="{{ $buku->harga }}"
                {{ old('buku_id', $penjualan->buku_id) == $buku->id_buku ? 'selected' : '' }}>
                {{ $buku->judul }} - Rp {{ number_format($buku->harga, 0, ',', '.') }}
            </option>
        @endforeach
    </select>
</div>


            <!-- Tanggal Transaksi -->
            <div class="mb-3">
                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                <input type="date" class="form-control @error('tanggal_transaksi') is-invalid @enderror"
                    id="tanggal_transaksi" name="tanggal_transaksi"
                    value="{{ old('tanggal_transaksi', $penjualan->tanggal_transaksi) }}" required>
                @error('tanggal_transaksi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah Buku</label>
                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                    name="jumlah" min="1" value="{{ old('jumlah', $penjualan->jumlah) }}" required
                    oninput="updateTotalHarga()">
                @error('jumlah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
    <label for="harga" class="form-label">Harga per Buku</label>
    <input type="number" step="0.01" class="form-control" id="harga" name="harga" value="{{ old('harga', $penjualan->harga) }}" readonly>
</div>


            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="number" class="form-control" id="total_harga" name="total_harga"
                    value="{{ old('total_harga', $penjualan->jumlah * $penjualan->harga) }}" readonly>
            </div>
            <div class="mb-3">
                <label for="pembayaran" class="form-label">Pembayaran</label>
                <input type="number" step="0.01" class="form-control" id="pembayaran" name="pembayaran"
                    value="{{ old('pembayaran', $penjualan->pembayaran) }}" readonly>
            </div>
            <div class="mb-3">
                <label for="kembalian" class="form-label">Kembalian</label>
                <input type="number" step="0.01" class="form-control" id="kembalian" name="kembalian"
                    value="{{ old('kembalian', $penjualan->kembalian) }}" readonly>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="pending" {{ old('status', $penjualan->status) == 'pending' ? 'selected' : '' }}>Pending
                    </option>
                    <option value="selesai" {{ old('status', $penjualan->status) == 'selesai' ? 'selected' : '' }}>Selesai
                    </option>
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
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
    function toggleBukuSelect() {
        const bukuSelect = document.getElementById('buku_id');
        const ubahBukuCheckbox = document.getElementById('ubah_buku');

        // Aktifkan atau nonaktifkan dropdown buku
        bukuSelect.disabled = !ubahBukuCheckbox.checked;
    }

    function updateHarga() {
        const bukuSelect = document.getElementById('buku_id');
        const hargaInput = document.getElementById('harga');
        const jumlahInput = document.getElementById('jumlah');
        const totalHargaInput = document.getElementById('total_harga');
        const pembayaranInput = document.getElementById('pembayaran');
        const kembalianInput = document.getElementById('kembalian');

        const selectedOption = bukuSelect.options[bukuSelect.selectedIndex];
        const harga = selectedOption ? selectedOption.getAttribute('data-harga') : null;

        if (harga) {
            hargaInput.value = parseFloat(harga).toFixed(2);
            const jumlah = parseInt(jumlahInput.value) || 0;
            const totalHarga = parseFloat(harga) * jumlah;
            totalHargaInput.value = totalHarga.toFixed(2);

            const pembayaran = parseFloat(pembayaranInput.value) || 0;
            const kembalian = pembayaran - totalHarga;
            kembalianInput.value = kembalian.toFixed(2);
        } else {
            hargaInput.value = '';
            totalHargaInput.value = '';
            kembalianInput.value = '';
        }
    }
</script>
@endsection