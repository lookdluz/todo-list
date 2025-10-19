<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class TaskCrudTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_create_task(){
        $user = User::factory()->create();
        $this->actingAs($user);
        $res = $this->post('/tasks',[ 'title'=>'Minha tarefa' ]);
        $res->assertRedirect();
        $this->assertDatabaseHas('tasks',[ 'title'=>'Minha tarefa','user_id'=>$user->id ]);
    }
}
