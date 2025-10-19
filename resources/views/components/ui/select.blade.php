@props(['name'])
<select name="{{ $name }}" {{ $attributes->class('select') }}>
{{ $slot }}
</select>
@error($name) <p class="mt-1 text-rose-400 text-sm">{{ $message }}</p> @enderror