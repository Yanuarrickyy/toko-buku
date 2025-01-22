@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Kategori - Edit</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- tempat button -->
            </div>
        </div>
        <div class="container mt-4">
            <form action="{{ route('master.data.kategori.update', $kategori->id_kategori) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Kategori -->
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                           id="category" name="nama" 
                           value="{{ old('nama', $kategori->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Keterangan (Text Area) -->
                <div class="mb-3">
                    <label for="description" class="form-label">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                              id="description" name="keterangan" 
                              rows="3" required>{{ old('keterangan', $kategori->keterangan) }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Status (select option) -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" name="status" required>
                        <option disabled value="">Pilih Status...</option>
                        <option value="aktif" {{ old('status', $kategori->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $kategori->status) == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection

{{-- untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
@endsection