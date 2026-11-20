<x-layout>
    <div class="py-6 sm:py-8 max-w-4xl mx-auto">
        <div class="flex flex-wrap justify-between items-center gap-3">
            <a href="{{ route('idea.index') }}"
                class="flex items-center gap-x-2 text-sm font-medium whitespace-nowrap">
                <x-lucide-arrow-left-to-line class="w-5 h-5 sm:w-6 sm:h-6 text-primary shrink-0" />
                <span>Back to Ideas</span>
            </a>

            <div class="flex items-center gap-2 sm:gap-3">
                <button x-data class="btn btn-outlined" data-test="edit-idea-button"
                    @click="$dispatch('open-modal','edit-idea')">
                    Edit Idea
                </button>

                <form method="POST" action="{{ route('idea.destroy', $idea) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outlined text-red-500">Delete</button>
                </form>
            </div>
        </div>

        <div class="mt-6 sm:mt-8 space-y-6">
            @if ($idea->image_path)
                <div>
                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('neon')->temporaryUrl($idea->image_path, now()->addMinutes(15)) }}"
                        alt="Idea featured image" class="w-full max-h-96 object-cover rounded-lg">
                </div>
            @endif

            <h1 class="font-bold text-2xl sm:text-3xl md:text-4xl break-words">{{ $idea->title }}</h1>

            <div class="mt-2 flex flex-wrap gap-3 items-center">
                <x-idea.status-label :status="$idea->status->value">{{ $idea->status->label() }}</x-idea.status-label>
                <div class="text-muted-foreground text-sm">{{ $idea->created_at->diffForHumans() }}</div>
            </div>

            @if ($idea->description)
                <x-card class="mt-6" is="div">
                    <div class="text-foreground max-w-none prose dark:prose-invert break-words overflow-x-auto">
                        {!! $idea->formattedDescription !!}
                    </div>
                </x-card>
            @endif

            @if ($idea->steps->count())
                <div>
                    <h3 class="font-bold text-lg sm:text-xl mt-6">Actionable Steps</h3>
                    <div class="mt-4 space-y-2">
                        @foreach ($idea->steps as $step)
                            <x-card is="div">
                                <form method="POST" action="{{ route('step.update', $step) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex items-start sm:items-center gap-x-3">
                                        <button type="submit" role="checkbox"
                                            class="size-5 shrink-0 mt-0.5 sm:mt-0 flex items-center justify-center rounded-lg text-primary-foreground {{ $step->completed ? 'bg-primary' : 'border border-primary' }}">
                                            <x-lucide-check class="size-4" />
                                        </button>
                                        <span class="min-w-0 break-words {{ $step->completed ? 'line-through text-muted-foreground' : '' }}">
                                            {{ $step->description }}
                                        </span>
                                    </div>
                                </form>
                            </x-card>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($idea->links->count())
                <div>
                    <h3 class="font-bold text-lg sm:text-xl mt-6">Links</h3>
                    <div class="mt-4 space-y-2">
                        @foreach ($idea->links as $link)
                            <x-card :href="$link"
                                class="text-primary font-medium flex gap-x-3 items-center break-all">
                                {{ $link }}
                            </x-card>
                        @endforeach
                    </div>
                </div>
            @endif

            <x-idea.modal :idea="$idea" />
        </div>
    </div>
</x-layout>