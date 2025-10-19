<x-app-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="h1">Minhas Tarefas</h1>
        <x-ui.button x-data x-on:click="window.dispatchEvent(new CustomEvent('open-modal',{detail:'new-task'}))">+ Nova tarefa</x-ui.button>
    </div>

    <form class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-3 card-glass p-4">
        <x-ui.input name="q" placeholder="Buscar..." value="{{ request('q') }}" />
        <x-ui.select name="status">
            <option value="">Status</option>
            @foreach(['todo','doing','done'] as $s)
                <option value="{{ $s }}" @selected(request('status')==$s)>{{ strtoupper($s) }}</option>
            @endforeach
        </x-ui.select>
        <x-ui.select name="priority">
            <option value="">Prioridade</option>
            @foreach(['low','medium','high'] as $p)
                <option value="{{ $p }}" @selected(request('priority')==$p)>{{ ucfirst($p) }}</option>
            @endforeach
        </x-ui.select>
        <x-ui.button type="submit" class="w-full">Filtrar</x-ui.button>
    </form>

    <div class="grid md:grid-cols-3 gap-4">
        @foreach($q as $task)
            <div class="card-glass p-4 space-y-3">
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <h3 class="font-semibold text-white/90">{{ $task->title }}</h3>
                        @if($task->due_date)
                            <p class="text-sm text-white/60">Prazo: {{ $task->due_date->format('d/m/Y') }}</p>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('tasks.complete',$task) }}">
                        @csrf
                        <x-ui.button variant="ghost">Concluir</x-ui.button>
                    </form>
                </div>
                <div class="flex gap-1 flex-wrap">
                    @foreach($task->tags as $tag)
                        <span class="badge" style="background: {{ $tag->color }}">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $q->links() }}
    </div>

    {{-- Modal Nova Tarefa --}}
    <x-ui.modal name="new-task">
        <x-slot name="title">Nova tarefa</x-slot>
        <form method="POST" action="{{ route('tasks.store') }}" class="space-y-3">
            @csrf
            <x-ui.input name="title" placeholder="Título" required />
            <x-ui.textarea name="description" placeholder="Descrição" />
            <div class="grid grid-cols-2 gap-3">
                <x-ui.select name="priority">
                    @foreach(['low','medium','high'] as $p)
                        <option value="{{ $p }}">{{ ucfirst($p) }}</option>
                    @endforeach
                </x-ui.select>
                <x-ui.input type="date" name="due_date" />
            </div>
            <div class="flex items-center justify-end gap-2 pt-2">
                <x-ui.button variant="ghost" x-on:click.prevent="document.dispatchEvent(new CustomEvent('open-modal',{detail:'_close'}))">Cancelar</x-ui.button>
                <x-ui.button type="submit">Salvar</x-ui.button>
            </div>
        </form>
    </x-ui.modal>
</x-app-layout>