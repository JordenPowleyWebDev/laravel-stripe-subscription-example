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
<div id="widget">
    <div class="widget-container">
        <main>
            @yield('content')
        </main>
    </div>
</div>
@stack('modals')
@include(config('laravel-components.views-namespace').'::components.toasts')
@stack('scripts')
</body>
</html>
