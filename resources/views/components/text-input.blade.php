@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>

{{-- @if ($attributes->has('type') && $attributes->get('type') === 'file') {
    $attributes = $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-white px-3 py-2']);
}  @endif --}}

{{-- @if (@isset($attributes['type']) && $attributes['type'] === 'file' && $attributes->has('value')) {
    <div class="-mt-2">
        <img src="{{ asset($attributes['value']) }}" alt="{{ $attributes['name'] ?? '' }}"
            class="w-24 h-24 object-cover rounded ">
    </div>
    }  @endif --}}
