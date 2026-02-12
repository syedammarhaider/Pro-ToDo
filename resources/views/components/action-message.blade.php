@props(['on'])

<div {{ $attributes->merge(['x-data' => "{ show: $dispatched === '{$on}' }", 'x-show' => 'show', 'x-transition' => '', 'class' => 'text-sm text-gray-600']) }}>
    {{ $slot }}
</div>
