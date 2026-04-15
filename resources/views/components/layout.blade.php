@props(['title' => 'Studio Legale', 'description' => '', 'robots' => 'index, follow', 'styles' => []])

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="{{ $robots }}">
    @if($description)
        <meta name="description" content="{{ $description }}">
    @endif

     <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(array_merge(['resources/css/app.css', 'resources/css/footer.css'], $styles, ['resources/js/app.js']))
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