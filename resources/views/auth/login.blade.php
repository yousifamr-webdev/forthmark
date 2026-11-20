<x-layout>
    <x-form title="Login" description="Glad to have you back.">
        <form action="/login" method="POST" class="mt-10 space-y-4">
            @csrf

            <x-form.field type="email" label="Email" name="email" />
            <x-form.field type="password" label="Password" name="password" />

            <button type="submit" class="btn mt-2 h-10 w-full">Login</button>
        </form>
        <div class="text-center flex mt-6 w-full">

            <span class="text-muted-foreground text-sm sm:text-base w-full">Don't have an
                account?&NonBreakingSpace;&NonBreakingSpace;&NonBreakingSpace;<a href="/register"
                    class="text-md w-full text-foreground hover:text-primary">Register</a></span>

        </div>

    </x-form>
</x-layout>
