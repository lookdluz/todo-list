<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $r, Task $task) {
        $this->authorize('view',$task);
        $data = $r->validate(['body'=>['required','string','max:5000']]);
        $task->comments()->create($data + ['user_id'=>$r->user()->id]);
        return back()->with('ok','Comentado');
    }
}