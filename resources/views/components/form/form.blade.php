@props(['title', 'description'])

<div class="flex min-h-[calc(100dvh-4rem)] items-center justify-center py-8 sm:py-12">
    <div class="w-full max-w-md">
        <div class="text-center">
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">{{ $title }}</h1>
            <p class="text-muted-foreground mt-1 text-sm sm:text-base">{{ $description }}</p>
        </div>

        {{ $slot }}
    </div>
</div>