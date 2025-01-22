<!doctype html>
<html lang="en">

<head>
    <script src="{{ asset('template/js/color-mode.js') }}"></script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.122.0" />
    <title>Register · Kelas Komputasi</title>
    {{-- untuk styles --}}
    @include('layouts.styles')
    {{-- untuk styles khusus halaman tertentu --}}
    @yield('this-page-style')

    <style>
        /* Fullscreen background */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            background: #1e3a5f;
        }

        /* Register Card */
        .form-signin {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        /* Heading */
        .form-signin h1 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 1rem;
            text-align: center;
        }

        /* Input Fields */
        .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 0.8rem;
            font-size: 1rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            color: #fff;
            padding: 0.8rem;
            font-size: 1rem;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #004085);
            transform: scale(1.05);
        }

        /* Login Link */
        .login-link {
            text-align: center;
            margin-top: 1rem;
        }

        .login-link a {
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <main class="form-signin">
        <!-- Menampilkan pesan error umum jika ada -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <!-- Heading -->
            <h1>Daftar Sebagai Anggota</h1>

            <!-- Input Nama -->
            <div>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Email -->
            <div>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Password -->
            <div>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Password Confirmation -->
            <div>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    placeholder="Password Confirmation" required>
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button class="btn btn-primary" type="submit">Register</button>
        </form>

        <!-- Link to Login -->
        <div class="login-link">
            <p>Already have an account? <a href="{{ route('login.form') }}">Log In</a></p>
        </div>
    </main>
</body>

</html>
