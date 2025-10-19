@props(['name','placeholder'=>null])
<textarea name="{{ $name }}" placeholder="{{ $placeholder }}" {{ $attributes->class('textarea') }}>{{ old($name) }}</textarea>
@error($name) <p class="mt-1 text-rose-400 text-sm">{{ $message }}</p> @enderror