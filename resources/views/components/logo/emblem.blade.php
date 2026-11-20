<svg {{ $attributes->merge(['class' => 'h-7 w-7 sm:h-8 sm:w-8 shrink-0']) }}
    viewBox="0 0 198 200" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
    {{-- Vertical stem --}}
    <rect x="0" y="0" width="42" height="200" class="fill-[#243B35] dark:fill-[#F5F6F2]" />

    {{-- Top angled bar (spans across stem in light mode; meets stem edge in dark mode) --}}
    <polygon points="0,0 198,0 170,42 0,42" class="fill-[#6B8471] dark:hidden" />
    <polygon points="42,0 198,0 170,42 42,42" class="hidden dark:block dark:fill-[#64806A]" />

    {{-- Middle angled bar --}}
    <polygon points="0,84 124,84 96,126 0,126" class="fill-[#9EB8A2] dark:fill-[#91B99A]" />

    {{-- Gold square mark --}}
    <rect x="138" y="84" width="42" height="42" class="fill-[#D9A441] dark:fill-[#D6AE62]" />
</svg>