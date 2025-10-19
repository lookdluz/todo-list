<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool {
        return true; // Autorização fina via Policy no Controller
    }


    public function rules(): array {
        return [
            'title' => ['sometimes','required','string','max:255'],
            'description' => ['sometimes','nullable','string'],
            'project_id' => ['sometimes','nullable','exists:projects,id'],
            'parent_id' => ['sometimes','nullable','exists:tasks,id'],
            'status' => ['sometimes','in:todo,doing,done'],
            'priority' => ['sometimes','in:low,medium,high'],
            'due_date' => ['sometimes','nullable','date'],
            'tags' => ['sometimes','array'],
            'tags.*' => ['exists:tags,id'],
        ];
    }
}