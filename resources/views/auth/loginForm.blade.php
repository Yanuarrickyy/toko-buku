<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="{{ asset('template/js/color-mode.js') }}"></script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.122.0" />
    <title>Login · Kelas Komputasi</title>
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
            background: linear-gradient(135deg, #1e3c72, #2a5298, #1e3c72);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* Login Card */
        .form-signin {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Icon Styling */
        .login-icon {
            background: #f4f4f4;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2.5rem;
            color: #888;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Input Fields */
        .form-floating input {
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .form-floating input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .form-floating label {
            color: #555;
            transition: all 0.3s ease;
        }

        .form-floating input:focus + label {
            color: #007bff;
            font-weight: bold;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            transition: all 0.3s ease;
            color: #fff;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #004085);
            transform: scale(1.05);
        }

        /* Footer */
        p {
            color: #333;
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <main class="form-signin w-100 m-auto">
        <!-- Menampilkan pesan error umum jika ada -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Login Icon -->
            <div class="login-icon">
                <i class="fas fa-user"></i>
            </div>
            <h1 class="h3 mb-3 fw-normal text-center" style="color: #333;">Selamat Datang !! Silahkan Login Dulu</h1>

            <!-- Input Email -->
            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                    placeholder="name@example.com" name="email" value="{{ old('email') }}">
                <label for="floatingInput">Email address</label>

                <!-- Menampilkan error untuk email -->
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Password -->
            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>

                <!-- Menampilkan error untuk password -->
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol untuk menampilkan/menyembunyikan password -->
            <div class="mt-2">
                <input type="checkbox" id="showPassword" onclick="togglePassword()">
                <label for="showPassword">Show Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Sign in</button>
            <a href="{{ route('register.form') }}" class="btn btn-primary w-100 py-2 mt-3">Register</a>
            <p class="mt-5 mb-3">&copy; Perpustakaan Online</p>
        </form>
    </main>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Script untuk fitur Show Password -->
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('floatingPassword');
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>

</html>
