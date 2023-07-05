<!DOCTYPE html>
<html lang="en">

@include('layouts.components.head')
<!--
  HOW TO USE:
  data-theme: default (default), dark, light, colored
  data-layout: fluid (default), boxed
  data-sidebar-position: left (default), right
  data-sidebar-layout: default (default), compact
-->

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<div class="wrapper">
    @include('layouts.components.sidebar')
    <div class="main">
        @include('layouts.components.header')
        <main class="content">
            <div class="container-fluid p-0">
                @yield('page-header')
                @yield('content')
            </div>
        </main>
        @include('layouts.components.footer')
    </div>
</div>
@include('layouts.components.footer-scripts')
</body>
</html>
