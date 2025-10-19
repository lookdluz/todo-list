<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'project_id' => ['nullable','exists:projects,id'],
            'parent_id' => ['nullable','exists:tasks,id'],
            'status' => ['in:todo,doing,done'],
            'priority' => ['in:low,medium,high'],
            'due_date' => ['nullable','date'],
            'tags' => ['array'],
            'tags.*' => ['exists:tags,id']
        ];
    }
}