<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Sneakers</title>
</head>
<body class="bg-gradient-to-r from-gray-100 to-gray-200">
    <div>
        {{-- Navigation --}}
        @include('layout.navigation')

        {{-- Content --}}
        @yield('content')

        {{-- Footer --}}
        <footer class="bg-red-500 text-1xl text-white text-center fixed inset-x-0 bottom-0 p-2">
            <p>created by song</p>
        </footer>
    </div>
    @yield('scripts')
</body>
</html>