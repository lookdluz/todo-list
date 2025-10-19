<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $r) {
        $projects = Project::where('user_id',$r->user()->id)
            ->latest()->paginate(12);
        return view('projects.index', compact('projects'));
    }

    public function create(){
        return view('projects.create');
    }

    public function store(Request $r) {
        $data = $r->validate([
            'name'=>['required','string','max:255'],
            'description'=>['nullable','string']
        ]);
        $project = Project::create($data + ['user_id'=>$r->user()->id]);
        return redirect()->route('projects.show',$project)->with('ok','Projeto criado');
    }

    public function show(Project $project) {
        $this->authorize('view',$project);
        $project->load(['tasks.tags']);
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project) {
        $this->authorize('update',$project);
        return view('projects.edit', compact('project')); 
    }

    public function update(Request $r, Project $project) {
        $this->authorize('update',$project);
        $data = $r->validate([
            'name'=>['required','string','max:255'],
            'description'=>['nullable','string']
        ]);
        $project->update($data);
        return redirect()->route('projects.show',$project)->with('ok','Atualizado');
    }

    public function destroy(Project $project) {
        $this->authorize('delete',$project); $project->delete();
        return to_route('projects.index')->with('ok','Removido');
    }
}