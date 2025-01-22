@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
    <!-- Tambahkan CSS untuk material design atau tema khusus jika diperlukan -->
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Profil - Update</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- tempat button -->
            </div>
        </div>
        
        @foreach ($user as $profil)
            <!-- Tampilkan data user -->
        @endforeach

        <div class="container mt-4">
        @if (session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-lg p-4 rounded d-flex align-items-center position-relative" role="alert" style="background: linear-gradient(135deg, #4caf50, #81c784); color: #fff; border: none; animation: slideIn 0.8s ease-out;">
    <i class="bi bi-emoji-smile-fill me-4" style="font-size: 2rem; animation: heartBeat 1.2s infinite;"></i>
    <div>
        <h5 class="mb-1 fw-bold" style="text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">Sukses!</h5>
        <p class="mb-0">{{ session('success') }}</p>
    </div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close" style="background: none; border: none; color: #fff; font-size: 1.2rem;"></button>
    <div class="position-absolute end-0 top-0 pe-3 pt-2" style="opacity: 0.8; font-size: 4rem; color: rgba(255, 255, 255, 0.1);">
        🌟
    </div>
</div>
@endif


<!-- Pesan Error -->
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show shadow-lg p-4 rounded d-flex align-items-center position-relative" role="alert" style="background: linear-gradient(135deg, #f44336, #e57373); color: #fff; border: none; animation: wobble 0.6s ease-in-out;">
    <i class="bi bi-emoji-dizzy-fill me-4" style="font-size: 2rem; animation: shakeX 1.5s infinite;"></i>
    <div>
        <h5 class="mb-1 fw-bold" style="text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">Ups, Ada Masalah!</h5>
        <p class="mb-0">{{ session('error') }}</p>
    </div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close" style="background: none; border: none; color: #fff; font-size: 1.2rem;"></button>
    <div class="position-absolute end-0 top-0 pe-3 pt-2" style="opacity: 0.8; font-size: 4rem; color: rgba(255, 255, 255, 0.1);">
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
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

@keyframes shakeX {
    0%, 100% {
        transform: translateX(0);
    }
    25%, 75% {
        transform: translateX(-10px);
    }
    50% {
        transform: translateX(10px);
    }
}

@keyframes wobble {
    0%, 100% {
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
            <form action="{{ route('profil.update', Auth::user()->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Untuk method PUT jika melakukan update -->

                <!-- Email -->
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', Auth::user()->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Sekarang -->
                <div class="mb-3">
                    <label for="password_sekarang">Password Sekarang</label>
                    <input type="password" name="password_sekarang" id="password_sekarang"
                        class="form-control @error('password_sekarang') is-invalid @enderror">
                    @error('password_sekarang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Baru -->
                <div class="mb-3">
                    <label for="password_baru">Password Baru</label>
                    <input type="password" name="password_baru" id="password_baru"
                        class="form-control @error('password_baru') is-invalid @enderror">
                    @error('password_baru')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Konfirmasi Password Baru -->
                <div class="mb-3">
                    <label for="password_baru_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" name="password_baru_confirmation" id="password_baru_confirmation"
                        class="form-control @error('password_baru_confirmation') is-invalid @enderror">
                    @error('password_baru_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection

{{-- untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
    <!-- Tambahkan JS jika diperlukan -->
@endsection