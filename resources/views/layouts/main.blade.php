<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="{{ asset('template/js/color-mode.js') }}"></script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.122.0" />
    <title>Dashboard Template · Bootstrap v5.3</title>
    {{-- untuk styles --}}
    @include('layouts.styles')
    {{-- untuk styles khusus halaman tertentu --}}
    @yield('this-page-style')
</head>

<body>

    {{-- untuk toggle tema --}}
    @include('layouts.theme')

    {{-- untuk header --}}
    @include('layouts.header')

    <div class="container-fluid">
        <div class="row">

            {{-- untuk sidebar --}}
            @include('layouts.sidebar')

            {{-- untuk content (akan berubah-ubah sesuai kebutuhan) --}}
            @yield('content')

        </div>
    </div>

    {{-- untuk scripts --}}
    @include('layouts.scripts')
    {{-- untuk scripts khusus halaman tertentu --}}
    @yield('this-page-scripts')
</body>

</html>

