<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Hilwa shop admin dashboard">
    <meta name="author" content="Mohammed Alajel">


    @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
        <link class="js-stylesheet" href="{{URL::asset('css/app.rtl.css')}}" rel="stylesheet">
    @else
        <link class="js-stylesheet" href="{{URL::asset('css/light.css')}}" rel="stylesheet">
    @endif
    @yield('css')

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="https://hwdolive.hilwawater.sa/images/hilwa-water-logo.svg"/>

    <link rel="canonical" href="https://demo.adminkit.io/pages-blank.html"/>

    <title>@yield('title','known')</title>


    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Choose your prefered color scheme -->
    <!-- <link href="css/light.css" rel="stylesheet"> -->
    <!-- <link href="css/dark.css" rel="stylesheet"> -->

    <!-- BEGIN SETTINGS -->
    <!-- Remove this after purchasing -->
    @if(\Illuminate\Support\Facades\App::getLocale() !== 'ar')
    <link class="js-stylesheet" href="{{URL::asset('css/light.css')}}" rel="stylesheet">
        <style>
            body {
                opacity: 0;
            }

        </style>
    <script src="{{URL::asset('js/settings.js')}}"></script>
    @endif


    <!-- END SETTINGS -->
    <script src="{{URL::asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
</head>
