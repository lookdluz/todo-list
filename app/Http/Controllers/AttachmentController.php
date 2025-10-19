<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AttachmentController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $r, Task $task) {
        $this->authorize('update',$task);
        $r->validate(['file'=>'required|file|max:5120']);
        $f = $r->file('file');
        $path = $f->store('attachments','public');
        $task->attachments()->create([
            'user_id'=>$r->user()->id,
            'path'=>$path,
            'original_name'=>$f->getClientOriginalName(),
            'size'=>$f->getSize(),
        ]);
        return back()->with('ok','Anexo enviado');
    }

    public function destroy(Attachment $attachment) {
        $task = $attachment->task; $this->authorize('update',$task);
        Storage::disk('public')->delete($attachment->path);
        $attachment->delete();
        return back()->with('ok','Anexo removido');
    }
}