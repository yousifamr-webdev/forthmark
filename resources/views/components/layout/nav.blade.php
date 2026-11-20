<nav x-data="{ open: false }" @keydown.escape.window="open = false" @click.away="open = false"
    class="border-b border-border px-4 sm:px-6">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between gap-4">
        <div class="shrink-0">
            <x-logo.full-logo />
        </div>

        {{-- Desktop navigation --}}
        <div class="hidden md:flex gap-x-4 items-center shrink-0">
            <x-btn.theme-toggle />

            @auth
                <a href="{{ route('profile.edit') }}" class="btn btn-outlined" aria-label="Edit profile">
                    <x-lucide-user class="w-5 h-5" />
                </a>

                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="btn btn-ghost">
                        <span>Log Out</span>
                        <x-lucide-log-out class="h-4 w-4" />
                    </button>
                </form>
            @endauth

            @guest
                <a href="/login" class="text-sm font-medium whitespace-nowrap px-2">Sign In</a>
                <a href="/register" class="btn">Register</a>
            @endguest
        </div>

        {{-- Mobile hamburger button --}}

        <div class="flex md:hidden items-center shrink-0">
            <x-btn.theme-toggle />
            @auth
                <button type="button" @click="open = !open" :aria-expanded="open" aria-controls="mobile-nav-menu"
                    aria-label="Toggle navigation menu" class="btn btn-outlined px-2.5">
                    <x-lucide-menu x-show="!open" class="h-5 w-5" aria-hidden="true" />
                    <x-lucide-x x-show="open" class="h-5 w-5" style="display: none" aria-hidden="true" />
                </button>
            @endauth
        </div>


    </div>

    {{-- Collapsible mobile menu --}}
    <div id="mobile-nav-menu" x-show="open" style="display: none" x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden border-t border-border py-4">
        <div class="max-w-7xl mx-auto flex flex-col gap-3">


            @auth
                <a href="{{ route('profile.edit') }}" class="btn btn-outlined w-full justify-start">
                    <x-lucide-user class="w-5 h-5" />
                    <span>Profile</span>
                </a>

                <form method="POST" action="/logout" class="w-full">
                    @csrf
                    <button type="submit" class="btn btn-ghost w-full justify-start">
                        <x-lucide-log-out class="h-4 w-4" />
                        <span>Logout</span>
                    </button>
                </form>
            @endauth


        </div>
    </div>
</nav>
