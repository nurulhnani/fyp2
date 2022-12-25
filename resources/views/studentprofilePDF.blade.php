<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Argon Dashboard') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Extra details for Live View on GitHub Pages -->

        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        
        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    </head>
    <body>
        <div class="row">
            <div class="col-sm-9">
                <h3>{{ $title }}</h3>
            </div>
            <div class="col-sm-3">
                <p>{{ $date }}</p>
            </div>
        </div>
        <div class="row mt-2">
            <h3><strong>Personal details</strong></h3>
        </div>
        <div class="row mt-2">
            <div class="col-sm-9">
                <p>Name: {{$student->name}}</p>
            </div>
            <div class="col-sm-3">
                <p>Mykid: {{$student->mykid}}</p>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-12">
                <p>Address: {{$student->address}}</p>
            </div>
        </div>     
    </body>
</html>