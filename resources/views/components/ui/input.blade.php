@props(['type'=>'text','name','value'=>null,'placeholder'=>null])
<input type="{{ $type }}" name="{{ $name }}" value="{{ old($name,$value) }}" placeholder="{{ $placeholder }}" {{ $attributes->class('input') }} />
@error($name) <p class="mt-1 text-rose-400 text-sm">{{ $message }}</p> @enderror