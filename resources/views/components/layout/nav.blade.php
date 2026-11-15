<nav class="border-b border-border px-6">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">
        <div>

            <a href="/">
                <img src="/images/logo.png" alt="Forthmark logo" width="250" class="dark:hidden">
                <img src="/images/logo_light.png" alt="Forthmark logo" width="250" class="hidden dark:block">
            </a>
        </div>

        <div class="flex gap-x-5 items-center">
            <x-btn.theme-toggle />
            @auth

                <a href="{{ route('profile.edit') }}" class="btn btn-outlined">
                    <x-lucide-user class="w-5 h-5" />
                </a>
                <form method="POST" action="/logout" class="flex items-center space-x-2 btn btn-ghost">
                    @csrf

                    <button>Log Out


                    </button>
                    <x-lucide-log-out class="h-4 w-4" />

                </form>
            @endauth

            @guest
                <a href="/login">Sign In</a>
                <a href="/register" class="btn">Register</a>
            @endguest
        </div>
    </div>
</nav>
