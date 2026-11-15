<x-layout>
  <x-form  title="Edit your Account" description="Need to make a tweak?">
    <form action="{{ route('profile.edit') }}" method="POST" class="mt-10 space-y-4">
      @csrf
      @method('PATCH')

      <x-form.field type="text" label="Name" name="name"  :value="$user->name" />
      <x-form.field type="email" label="Email" name="email"  :value="$user->email" />
      <x-form.field type="password" label="New Password" name="password"  />
      
      <button type="submit" class="btn mt-2 h-10 w-full">Update Account</button>
    </form>
  </x-form>
</x-layout>