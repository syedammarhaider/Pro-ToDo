@props(['messages'])

@if ($messages && (is_array($messages) ? count($messages) > 0 : $messages->isNotEmpty()))
    <div {{ $attributes->merge(['class' => 'mt-2 text-sm text-red-600']) }}>
        {{ is_array($messages) ? (is_object($messages[0]) ? $messages[0] : $messages[0]) : $messages->first() }}
    </div>
@endif
