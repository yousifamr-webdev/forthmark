<x-layout>
    <div>
        <header class="py-6 sm:py-8 md:py-12">
            <h1 class="text-2xl sm:text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>

            <x-card x-data @click="$dispatch('open-modal','create-idea')" is="button" type="button"
                data-test="create-idea-button" class="mt-6 sm:mt-10 cursor-pointer h-24 sm:h-32 w-full text-left">
                <p>What's the idea?</p>
            </x-card>

            <div class="mt-6 flex flex-wrap gap-2">
                <a href="/ideas" class="btn {{ request()->has('status') ? 'btn-outlined' : '' }}">All</a>
                @foreach (App\IdeaStatus::cases() as $status)
                    <a href="/ideas?status={{ $status->value }}"
                        class="btn {{ request('status') === $status->value ? '' : 'btn-outlined' }}">
                        <span>{{ $status->label() }}</span>
                        <span class="text-xs opacity-80">{{ $statusCounts->get($status->value) }}</span>
                    </a>
                @endforeach
            </div>
        </header>

        <div class="text-foreground">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                @forelse ($ideas as $idea)
                    <x-card href="{{ route('idea.show', $idea) }}" class="min-w-0">
                        @if ($idea->image_path)
                            <div class="mb-4 -mx-4 -mt-4 rounded-t-lg overflow-hidden">
                                <img src="{{ \Illuminate\Support\Facades\Storage::disk('neon')->temporaryUrl($idea->image_path, now()->addMinutes(15)) }}"
                                    alt="Idea featured image" class="w-full h-44 sm:h-48 object-cover">
                            </div>
                        @endif

                        <h3 class="text-foreground text-lg font-medium break-words">{{ $idea->title }}</h3>

                        <div class="mt-1">
                            <x-idea.status-label status="{{ $idea->status }}">
                                {{ $idea->status->label() }}
                            </x-idea.status-label>
                        </div>

                        <div class="{{ $idea->description ? 'mt-4 line-clamp-3 break-words' : 'hidden' }}">
                            {{ $idea->description }}
                        </div>

                        <div class="mt-4 text-xs text-muted-foreground">
                            {{ $idea->created_at->diffForHumans() }}
                        </div>
                    </x-card>
                @empty
                    <x-card is="div" class="md:col-span-2 text-center text-muted-foreground py-8">
                        No ideas at this time.
                    </x-card>
                @endforelse
            </div>
        </div>

        <x-idea.modal />
    </div>
</x-layout>