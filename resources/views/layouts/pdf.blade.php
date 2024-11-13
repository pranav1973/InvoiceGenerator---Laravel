<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <style>
        body {
            background: inherit;
            font-size: 14px;
        }

        ,
        .tbl-total {
            width: inherit;
            border: 0;
        }

        .tbl-total th,
        .tbl-total tr,
        .tbl-total td {
            border: 0;
        }
    </style>
</head>

<body>
    @yield('content')
</body>

</html>
