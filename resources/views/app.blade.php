<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {{-- 👇 Add Google Fonts here --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Sora:wght@100..800&display=swap"
        rel="stylesheet">
    @viteReactRefresh
    {{-- Tailwind + React entry --}}
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
</head>

<body>
    <div>ifewuewufb</div>
    <div id="root"></div>
</body>

</html>
