<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ 'Dinas Pendidikan Kabupaten Ponorogo' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{--
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"> --}}

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Google tag (gtag.js) -->
    {{--
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-H9JWC4EMHQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag () { dataLayer.push( arguments ); }
        gtag( 'js', new Date() );

        gtag( 'config', 'G-H9JWC4EMHQ' );
    </script> --}}

</head>

{{-- Layout For Livewire Admin Panel --}}

<body
    class="min-h-screen bg-gray-100 dark:bg-slate-900 scrollbar-thin scrollbar-thumb-primary scrollbar-track-gray-100/50 scrollbar-thumb-rounded-full scrollbar-track-rounded-full overscroll-none">

    <livewire:bale-dindik.shared-components.topbar />

    <main>
        {{ $slot }}
    </main>

    <livewire:bale-dindik.landing-page.footer.index />
    @livewireScripts

</body>

</html>