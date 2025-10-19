<x-app-layout>
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-white">Minhas Tarefas</h1>
        <x-ui.button x-data x-on:click="window.dispatchEvent(new CustomEvent('open-modal',{detail:'new-task'}))" class="btn-primary">
            + Nova Tarefa
        </x-ui.button>
    </div>

    <form class="card-glass p-5 grid md:grid-cols-4 gap-3 mb-8">
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

    <div class="grid md:grid-cols-3 gap-5">
        @foreach($q as $task)
            <div class="card-glass p-5 hover:scale-[1.02] transition-transform">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <h3 class="font-semibold text-lg text-white/90">{{ $task->title }}</h3>
                        @if($task->due_date)
                            <p class="text-sm text-white/60">Prazo: {{ $task->due_date->format('d/m/Y') }}</p>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('tasks.complete',$task) }}">
                        @csrf
                        <x-ui.button variant="ghost" class="text-sm px-2 py-1">Concluir</x-ui.button>
                    </form>
                </div>
                <div class="flex flex-wrap gap-1">
                    @foreach($task->tags as $tag)
                        <span class="badge" style="background: {{ $tag->color }}">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $q->links() }}
    </div>

    {{-- Modal Nova Tarefa --}}
    <x-ui.modal name="new-task">
        <x-slot name="title">Nova Tarefa</x-slot>
        <form method="POST" action="{{ route('tasks.store') }}" class="space-y-4">
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
            <div class="flex justify-end gap-2 pt-3">
                <x-ui.button variant="ghost" x-on:click.prevent="open=false">Cancelar</x-ui.button>
                <x-ui.button type="submit">Salvar</x-ui.button>
            </div>
        </form>
    </x-ui.modal>
</x-app-layout>