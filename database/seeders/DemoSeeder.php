<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Task;

class DemoSeeder extends Seeder
{
    public function run(): void {
        $user = User::factory()->create(['email'=>'demo@example.com']);
        $projects = Project::factory(2)->for($user)->create();
        $tags = Tag::factory()->createMany([
            ['name'=>'Work','color'=>'#0ea5e9'],
            ['name'=>'Personal','color'=>'#10b981'],
            ['name'=>'Urgent','color'=>'#ef4444'],
        ]);
        Task::factory(15)->for($user)->recycle($projects)->create()->each(function($t) use ($tags){
        $t->tags()->sync($tags->random(rand(0,2))->pluck('id'));
    });
}
}