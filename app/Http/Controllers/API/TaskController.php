<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    public function index(Request $r) {
        $tasks = Task::owned(Auth::user())
            ->with(['tags','subtasks'])
            ->when($r->filled('status'), fn($q)=>$q->where('status',$r->status))
            ->when($r->filled('priority'), fn($q)=>$q->where('priority',$r->priority))
            ->when($r->filled('q'), fn($q)=>$q->search($r->q))
            ->latest()->paginate(20)->withQueryString();
        return response()->json($tasks);
    }

    public function store(StoreTaskRequest $r) {
        $task = Task::create($r->validated() + ['user_id'=>Auth::id()]);
        if($r->filled('tags')) $task->tags()->sync($r->tags);
        return response()->json($task->load('tags'), 201);
    }

    public function show(Task $task) {
        $this->authorize('view',$task);
        return response()->json($task->load(['tags','subtasks','comments','attachments']));
    }

    public function update(UpdateTaskRequest $r, Task $task) {
        $this->authorize('update',$task);
        $task->update($r->validated());
        if($r->has('tags')) $task->tags()->sync($r->tags ?? []);
        return response()->json($task->load('tags'));
    }

    public function destroy(Task $task) {
        $this->authorize('delete',$task);
        $task->delete();
        return response()->noContent();
    }

    public function complete(Task $task) {
        $this->authorize('update',$task);
        $task->update(['status'=>'done','completed_at'=>now()]);
        return response()->json($task);
    }
}