<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>

            <x-card x-data @click="$dispatch('open-modal','create-idea')" is="button" type="button"
                data-test="create-idea-button" class="mt-10 cursor-pointer h-32 w-full text-left">

                <p> What's the idea?</p>

            </x-card>

            <div class="mt-6">
                <a href="/ideas" class="btn {{ request()->has('status') ? 'btn-outlined' : '' }}">All</a>
                @foreach (App\IdeaStatus::cases() as $status)
                    <a href="/ideas?status={{ $status->value }}"
                        class="btn {{ request('status') === $status->value ? '' : 'btn-outlined' }} ">
                        {{ $status->label() }}<span class="text-xs pl-3">{{ $statusCounts->get($status->value) }}</span>
                    </a>
                @endforeach
            </div>
        </header>
        <div class="text-foreground">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse ($ideas as $idea)
                    <x-card href="{{ route('idea.show', $idea) }}">
                        @if ($idea->image_path)
                            <div class="mb-4 -mx-4 -mt-4 rounded-t-lg overflow-hidden "> <img
                                    src="{{ \Illuminate\Support\Facades\Storage::disk('neon')->temporaryUrl($idea->image_path, now()->addMinutes(15)) }}" alt="Idea featured image"
                                    class="w-full h-48 object-cover"></div>
                        @endif
                        <h3 class="text-foreground text-lg">{{ $idea->title }}</h3>
                        <div class="mt-1">
                            <x-idea.status-label status="{{ $idea->status }}">
                                {{ $idea->status->label() }}
                            </x-idea.status-label>
                        </div>
                        <div class="{{ $idea->description ? 'mt-5 line-clamp-3' : 'hidden' }}">
                            {{ $idea->description }}</div>
                        <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
                    </x-card>
                @empty
                    <x-card>No ideas at this time.</x-card>
                @endforelse
            </div>

        </div>
        
        <x-idea.modal/>



    </div>
</x-layout>
