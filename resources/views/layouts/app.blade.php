<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <base href="{{ asset('/') }}" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ env('APP_NAME') }} - @yield('title')</title>
        @include('layouts.includes.styles')
    </head>
    <body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-minimize-hoverable aside-fixed page-loading">
        <x-base.layout/>
    </body>
</html>
