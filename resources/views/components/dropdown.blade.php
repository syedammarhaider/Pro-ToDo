@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1'])

<div x-data="{ open: false }" class="relative">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute z-50 mt-2 {{ $width === '48' ? 'w-48' : '' }} rounded-md shadow-lg {{ $align === 'right' ? 'right-0' : 'left-0' }} bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
         style="display: none;"
    >
        <div class="{{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
