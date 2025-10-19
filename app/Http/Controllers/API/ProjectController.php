<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
	use AuthorizesRequests;

    public function index() {
        $projects = Project::where('user_id',Auth::id())->latest()->paginate(20);
        return response()->json($projects);
    }

    public function store(Request $r) {
        $data = $r->validate(['name'=>['required','string','max:255'],'description'=>['nullable','string']]);
        $project = Project::create($data + ['user_id'=>Auth::id()]);
        return response()->json($project,201);
    }

    public function show(Project $project) {
        $this->authorize('view',$project);
        return response()->json($project->load('tasks.tags'));
    }

    public function update(Request $r, Project $project) {
        $this->authorize('update',$project);
        $data = $r->validate(['name'=>['required','string','max:255'],'description'=>['nullable','string']]);
        $project->update($data);
        return response()->json($project);
    }

    public function destroy(Project $project) {
        $this->authorize('delete',$project);
        $project->delete();
        return response()->noContent();
    }
}