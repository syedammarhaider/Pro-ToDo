@props(['name', 'id', 'type' => 'text', 'value' => ''])

<input 
    {{ $attributes->merge(['type' => $type, 'name' => $name, 'id' => $id ?? $name, 'value' => $value]) }}
    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm {{ $errors->has($name) ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : '' }}"
>
