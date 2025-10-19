@props(['variant' => 'primary', 'type' => 'button'])
<button type="{{ $type }}"
    {{ $attributes->class([
        'btn',
        'btn-primary' => $variant==='primary',
        'btn-ghost' => $variant==='ghost',
        'btn-danger' => $variant==='danger',
    ]) }}>
    {{ $slot }}
</button>