<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;
    
    public function index(Request $r) {
        $q = Task::owned($r->user())
            ->with(['tags','subtasks'])
            ->when($r->filled('status'), fn($q)=>$q->where('status',$r->status))
            ->when($r->filled('priority'), fn($q)=>$q->where('priority',$r->priority))
            ->when($r->filled('q'), fn($q)=>$q->search($r->q))
            ->orderByRaw("FIELD(status,'doing','todo','done')")
            ->orderBy('due_date')
            ->paginate(12)
            ->withQueryString();
        
            return view('tasks.index', compact('q'));
    }


    public function store(StoreTaskRequest $r) {
        $task = Task::create($r->validated() + ['user_id'=>$r->user()->id]);
        if($r->filled('tags')) $task->tags()->sync($r->tags);
        return back()->with('ok','Tarefa criada!');
    }


    public function update(UpdateTaskRequest $r, Task $task) {
        $this->authorize('update',$task);
        $task->update($r->validated());
        if($r->filled('tags')) $task->tags()->sync($r->tags);
        return back()->with('ok','Atualizada!');
    }


    public function destroy(Task $task) {
        $this->authorize('delete',$task); $task->delete();
        return back()->with('ok','Removida.');
    }


    public function complete(Task $task) {
        $this->authorize('update',$task); $task->update(['status'=>'done','completed_at'=>now()]);
        return back();
    }
}