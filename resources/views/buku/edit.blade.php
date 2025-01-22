@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Buku - Edit</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- tempat button -->
            </div>
        </div>
        <div class="container mt-4">
            <form action="{{ route('master.data.buku.update', $buku->id_buku) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')            

                <!-- Kategori -->
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}"
                                {{ old('kategori_id', $buku->kategori_id) == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Judul -->
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" 
                           value="{{ old('judul', $buku->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>                

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" 
                              rows="3" required>{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Penulis -->
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis" name="penulis" 
                           value="{{ old('penulis', $buku->penulis) }}" required>
                    @error('penulis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Cover Buku -->
                <div class="mb-3">
                    <label for="cover" class="form-label">Cover Buku</label>
                    <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover" 
                           accept="image/*" onchange="previewImage(event)" />
                    @error('cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <!-- Preview Image -->
                    <div class="mt-3" id="cover-preview" style="display: {{ $buku->cover ? 'block' : 'none' }}">
                        <label for="cover" class="form-label">Pratinjau Cover:</label>
                        <img id="cover-image" src="{{ asset($buku->cover) }}" alt="Cover Preview" class="img-fluid"
                             style="max-width: 200px" />
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="aktif" {{ old('status', $buku->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $buku->status) == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
    <label for="harga" class="form-label">Harga</label>
    <input type="number" step="0.01" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" 
        value="{{ old('harga', $buku->harga ?? '') }}" required>
    @error('harga')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


                <button type="submit" class="btn btn-primary">Update Buku</button>
            </form>
        </div>
    </main>
@endsection

{{-- untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
    <script>
        // Function to preview image
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const imagePreview = document.getElementById("cover-image");
                const previewContainer = document.getElementById("cover-preview");
                imagePreview.src = reader.result;
                previewContainer.style.display = "block";
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection