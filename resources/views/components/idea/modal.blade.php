@props(['idea' => new App\Models\Idea()])

<x-modal name="{{ $idea->exists ? 'edit-idea' : 'create-idea' }}"
    title="{{ $idea->exists ? 'Edit Idea' : 'Create Idea' }}">
    <form x-data="{
        status: @js(old('status', $idea->status->value)),
        newLink: '',
        links: @js(old('links', $idea->links ?? [])),
        newStep: '',
        steps: @js(old('steps', $idea->steps->map->only(['id', 'description', 'completed'])))
    }" method="POST"
        action="{{ $idea->exists ? route('idea.update', $idea) : route('idea.store') }}"
        enctype="multipart/form-data">
        @csrf
        @if ($idea->exists)
            @method('PATCH')
        @endif

        <div class="space-y-5 sm:space-y-6">
            <x-form.field label="Title" name="title" data-test="title"
                placeholder="Enter an idea for your title" autofocus required :value="$idea->title" />

            <div class="space-y-2">
                <label for="status" class="label">Status</label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 sm:gap-3">
                    @foreach (App\IdeaStatus::cases() as $status)
                        <button type="button" @click="status = @js($status->value)"
                            data-test="button-status-{{ $status->value }}" class="btn w-full h-10"
                            :class="status === @js($status->value) ? '' : 'btn-outlined'">
                            {{ $status->label() }}
                        </button>
                    @endforeach
                </div>
                <input type="text" name="status" :value="status" class="hidden">
                <x-form.error name="status" />
            </div>

            <x-form.field label="Description" type="textarea" name="description"
                placeholder="Describe your idea..." :value="$idea->description" />

            <div class="space-y-2">
                <label for="image" class="label">Featured Image</label>
                @if ($idea->image_path)
                    <div class="space-y-2">
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('neon')->temporaryUrl($idea->image_path, now()->addMinutes(15)) }}"
                            alt="Idea featured image" class="w-full h-40 sm:h-48 object-cover rounded-lg">
                        <button class="btn btn-outlined h-10 w-full" form="delete-image-form">Remove Image</button>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*">
                <x-form.error name="image" />
            </div>

            <div>
                <fieldset class="space-y-3">
                    <legend class="label">Actionable Steps</legend>

                    <template x-for="(step, index) in steps" :key="step.id ?? index">
                        <div class="flex gap-x-2 items-center">
                            <input class="input min-w-0 flex-1" :name="`steps[${index}][description]`"
                                x-model="step.description" readonly>
                            <input type="hidden" :name="`steps[${index}][completed]`"
                                :value="step.completed ? '1' : '0'">
                            <button type="button" aria-label="Remove step" class="shrink-0 p-1"
                                @click="steps.splice(index, 1)">
                                <x-lucide-x class="h-6 w-6 form-muted-icon" />
                            </button>
                        </div>
                    </template>

                    <div class="flex gap-x-2 items-center">
                        <input x-model="newStep" data-test="new-step" id="new-step"
                            placeholder="What needs to be done?" class="input min-w-0 flex-1" spellcheck="false">
                        <button type="button" data-test="submit-new-step-button" class="shrink-0 p-1"
                            @click="steps.push({description: newStep.trim(), completed: false}); newStep = '';"
                            :disabled="newStep.trim().length === 0" aria-label="Add a new step">
                            <x-lucide-plus class="h-6 w-6 text-primary" />
                        </button>
                    </div>
                </fieldset>
            </div>

            <div>
                <fieldset class="space-y-3">
                    <legend class="label">Links</legend>

                    <template x-for="(link, index) in links" :key="index">
                        <div class="flex gap-x-2 items-center">
                            <input class="input min-w-0 flex-1" name="links[]" x-model="links[index]">
                            <button type="button" aria-label="Remove link" class="shrink-0 p-1"
                                @click="links.splice(index, 1)">
                                <x-lucide-x class="h-6 w-6 form-muted-icon" />
                            </button>
                        </div>
                    </template>

                    <div class="flex gap-x-2 items-center">
                        <input x-model="newLink" type="url" id="new-link" data-test="new-link"
                            placeholder="http://example.com" autocomplete="url" class="input min-w-0 flex-1"
                            spellcheck="false">
                        <button type="button" data-test="submit-new-link-button" class="shrink-0 p-1"
                            @click="links.push(newLink.trim()); newLink = '';"
                            :disabled="newLink.trim().length === 0" aria-label="Add a new link">
                            <x-lucide-plus class="h-6 w-6 text-primary" />
                        </button>
                    </div>
                </fieldset>
            </div>

            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-2">
                <button type="button" class="btn btn-ghost w-full sm:w-auto" @click="$dispatch('close-modal')">
                    Cancel
                </button>
                <button type="submit" name="{{ $idea->exists ? 'Update' : 'Create' }}"
                    class="btn w-full sm:w-auto">
                    {{ $idea->exists ? 'Update' : 'Create' }}
                </button>
            </div>
        </div>
    </form>

    @if ($idea->image_path)
        <form method="POST" action="{{ route('idea.image.destroy', $idea) }}" id="delete-image-form">
            @csrf
            @method('DELETE')
        </form>
    @endif
</x-modal>