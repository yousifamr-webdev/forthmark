<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>forthmark</title>
    <link rel="icon" type="image/avif" href="{{ asset('emblem.avif') }}">

    <script>
        if (
            localStorage.getItem('theme') === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="bg-background text-foreground min-h-dvh overflow-x-hidden">
    <x-layout.nav />
    <main class="w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        {{ $slot }}
    </main>

    @session('success')
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            x-transition.opacity.duration.300ms
            class="fixed bottom-4 inset-x-4 sm:inset-x-auto sm:right-4 z-50 bg-primary px-4 py-3 border rounded-lg text-primary-foreground text-center sm:text-left shadow-lg">
            {{ $value }}
        </div>
    @endsession
</body>

</html>
