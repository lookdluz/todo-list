@props(['name'])
<div x-data="{ open:false }" x-on:open-modal.window="if($event.detail==='{{ $name }}') open=true" x-on:keydown.escape.window="open=false">
<div x-show="open" x-transition.opacity class="fixed inset-0 z-50 bg-black/60"></div>
<div x-show="open" x-transition class="fixed inset-0 z-50 grid place-items-center p-4">
<div class="card-glass w-full max-w-lg" role="dialog" aria-modal="true">
<div class="flex items-center justify-between p-4 border-b border-white/10">
<h3 class="h2">{{ $title ?? 'Modal' }}</h3>
<button class="btn-ghost" x-on:click="open=false">✕</button>
</div>
<div class="p-4">{{ $slot }}</div>
</div>
</div>
</div>