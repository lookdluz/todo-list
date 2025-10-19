<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index() {
        $tags = Tag::query()->orderBy('name')->paginate(20);
        return view('tags.index', compact('tags'));
    }

    public function store(Request $r) {
        $data = $r->validate([
            'name'=>['required','string','max:64','unique:tags,name'],
            'color'=>['nullable','regex:/^#([0-9a-fA-F]{3}){1,2}$/']
        ]);
        $data['color'] = $data['color'] ?? '#64748b';
        Tag::create($data);
        return back()->with('ok','Tag criada');
    }

    public function destroy(Tag $tag) {
        $tag->delete();
        return back()->with('ok','Tag removida');
    }
}