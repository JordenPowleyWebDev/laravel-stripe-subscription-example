<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ isset($pageTitle) && filled($pageTitle) ? $pageTitle : config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8">
    <meta name="author" content="Jorden Powley">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/widget.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/widget.css') }}" rel="stylesheet">
</head>
<body>
<div id="widget" class="row m-0 p-0 d-flex justify-content-center align-items-center">
    <div class="col-12 col-md-10 col-lg-8 col-xl-6 col-xxl-4 m-0 p-4 p-xl-5 d-flex justify-content-center align-items-stretch">
        <main class="w-100" id="widget-content-container">
            @yield('content')
        </main>
    </div>
</div>
@stack('modals')
@include(config('laravel-components.views-namespace').'::components.toasts')
@stack('scripts')
</body>
</html>
