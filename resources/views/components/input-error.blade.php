@props(['messages'])

@if ($messages && $messages->isNotEmpty())
    <div {{ $attributes->merge(['class' => 'mt-2 text-sm text-red-600']) }}>
        {{ $messages->first() }}
    </div>
@endif
