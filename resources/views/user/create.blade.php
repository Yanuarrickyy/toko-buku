@extends('layouts.main')
 {{-- untuk styles khusus halaman tertentu --}}
 @section('this-page-style')
 @endsection
 @section('content')
     <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <div
             class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
             <h1 class="h2">User - Tambah</h1>
             <div class="btn-toolbar mb-2 mb-md-0">
                 <!-- tempat button -->
             </div>
         </div>
         <div class="container mt-4">
             <form action="{{ route('master.data.user.store') }}" method="POST">
                 @csrf
                 <div class="mb-3">
                     <label for="name">Nama</label>
                     <input type="text" name="name" id="name"
                         class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                     @error('name')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                     @enderror
                 </div>
                 <div class="mb-3">
                     <label for="email">Email</label>
                     <input type="email" name="email" id="email"
                         class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                     @error('email')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                     @enderror
                 </div>
                 <div class="mb-3">
                     <label for="password">Password</label>
                     <input type="password" name="password" id="password"
                         class="form-control @error('password') is-invalid @enderror" required>
                     @error('password')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                     @enderror
                 </div>
                 <!-- Role (select option) -->
                 <div class="mb-3">
                     <label for="role">Role</label>
                     <select name="role" id="role" class="form-control @error('role') is-invalid @enderror"
                         required>
                         <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin
                         </option>
                         <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                         <option value="pengguna" {{ old('role') == 'pengguna' ? 'selected' : '' }}>Pengguna</option>
                     </select>
                     @error('role')
                         <div class="invalid-feedback">
                             {{ $message }}
                         </div>
                     @enderror
                 </div>

                 <!-- Submit Button -->
                 <div class="mb-3">
                     <button class="btn btn-primary" type="submit">
                         Simpan
                     </button>
                 </div>
             </form>
         </div>
     </main>
 @endsection
 {{-- untuk scripts khusus halaman tertentu --}}
 @section('this-page-scripts')
 @endsection
