<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model 
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'project_id',
        'parent_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'completed_at'
    ];

    protected $casts = [
        'due_date' => 'date',
        'completed_at' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function parent(){
        return $this->belongsTo(Task::class, 'parent_id');
    }

    public function subtasks(){
        return $this->hasMany(Task::class, 'parent_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    public function attachments(){
        return $this->hasMany(Attachment::class); 
    }
    
    public function scopeOwned($q, User $user){
        return $q->where('user_id',$user->id);
    }
    
    public function scopeSearch($q, $term){
        $t = "%".trim($term)."%";
        
        return $q->where(fn($w)=>$w->where('title','like',$t)->orWhere('description','like',$t));
    }
}
