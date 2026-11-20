@props(['name', 'title'])

<div x-data="{ show: false, name: @js($name) }" x-show="show"
    @open-modal.window="if($event.detail === name) show = true;"
    @close-modal="show = false"
    @keydown.escape.window="show = false"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-black/50 backdrop-blur-xs"
    x-transition:enter="ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-4"
    style="display: none" role="dialog" aria-modal="true"
    aria-labelledby="modal-{{ $name }}-title" :aria-hidden="!show" tabindex="-1">

    <x-card is="div" @click.away="show = false"
        class="shadow-xl max-w-xl w-full max-h-[85dvh] sm:max-h-[80dvh] overflow-y-auto p-4 sm:p-6">
        <div class="flex justify-between items-center gap-4">
            <h2 id="modal-{{ $name }}-title" class="text-lg sm:text-xl font-bold">{{ $title }}</h2>
            <button type="button" @click="show = false" aria-label="Close modal" class="shrink-0 p-1">
                <x-lucide-x class="w-6 h-6 text-primary" />
            </button>
        </div>
        <div class="mt-4">{{ $slot }}</div>
    </x-card>
</div>