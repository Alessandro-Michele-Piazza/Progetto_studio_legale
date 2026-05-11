@props(['title' => 'Studio Legale', 'description' => '', 'robots' => 'index, follow', 'styles' => [], 'ogTitle' => '', 'ogDescription' => '', 'ogUrl' => '', 'ogType' => 'website'])

<!DOCTYPE html>
<html lang="it">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="{{ $robots }}">
    @if($description)
        <meta name="description" content="{{ $description }}">
    @endif

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $ogTitle ?: $title }}">
    @if($description)
        <meta property="og:description" content="{{ $ogDescription ?: $description }}">
    @endif
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:url" content="{{ $ogUrl ?: url()->current() }}">
    <meta property="og:locale" content="it_IT">
    <meta property="og:site_name" content="Studi Legali Consorziati">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $ogTitle ?: $title }}">
    @if($description)
        <meta name="twitter:description" content="{{ $ogDescription ?: $description }}">
    @endif

    <link rel="canonical" href="{{ $ogUrl ?: url()->current() }}">

    @vite(array_merge(['resources/css/app.css', 'resources/css/footer.css'], $styles, ['resources/js/app.js']))
    <link rel="preload" href="{{ Vite::asset('resources/css/fonts-optional.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ Vite::asset('resources/css/fonts-optional.css') }}">
    </noscript>
    <link rel="preload" href="{{ Vite::asset('resources/css/icons.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ Vite::asset('resources/css/icons.css') }}">
    </noscript>
    <title>{{ $title }}</title>

</head>

<body>
    <x-navbar />

    <main>
        {{ $slot }}
    </main>

    <x-footer />

    @stack('scripts')
</body>

</html>