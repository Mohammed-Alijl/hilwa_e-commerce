<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Hilwa Admin Dashboard">
    <meta name="author" content="Mohammed Alajel">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="https://hwdolive.hilwawater.sa/images/hilwa-water-logo.svg" />

    <link rel="canonical" href="https://demo.adminkit.io/pages-sign-in.html" />

    <title>Sign In | Hilwa</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Choose your prefered color scheme -->
    <!-- <link href="css/light.css" rel="stylesheet"> -->
    <!-- <link href="css/dark.css" rel="stylesheet"> -->

    <!-- BEGIN SETTINGS -->
    <!-- Remove this after purchasing -->
    <link class="js-stylesheet" href="{{URL::asset('css/light.css')}}" rel="stylesheet">
    <script src="{{URL::asset('js/settings.js')}}"></script>
    <style>
        body {
            opacity: 0;
        }
    </style>
    <!-- END SETTINGS -->
</head>
<!--
  HOW TO USE:
  data-theme: default (default), dark, light, colored
  data-layout: fluid (default), boxed
  data-sidebar-position: left (default), right
  data-sidebar-layout: default (default), compact
-->

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<main class="d-flex w-100 h-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Welcome back!</h1>
                        <p class="lead">
                            Sign in to your account to continue
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <div class="d-grid gap-2 mb-3">
                                    <img src="https://hwdolive.hilwawater.sa/images/hilwa-water-logo.svg" style="width: 50%;transform: translate(50%, 0px);">
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <hr>
                                    </div>
                                    <div class="col-auto text-uppercase d-flex align-items-center">Sign in</div>
                                    <div class="col">
                                        <hr>
                                    </div>
                                </div>
                                <x-auth-session-status class="mb-4" :status="session('status')" />
                                <form method="post" action="{{route('login')}}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email"/>
                                        @error('email')
                                        <p class="mt-2 erro">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
                                    </div>
                                    <div>
                                        <div class="form-check align-items-center">
                                            <input id="customControlInline" type="checkbox" class="form-check-input" name="remember"
                                                   checked>
                                            <label class="form-check-label text-small" for="customControlInline">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 mt-3">
                                        <input type="submit" class="btn btn-lg btn-primary" value="Sign in">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="{{URL::asset('js/app.js')}}"></script>

</body>

</html>
