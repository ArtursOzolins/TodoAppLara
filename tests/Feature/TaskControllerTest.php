<?php

namespace Tests\Feature;

use App\Http\Controllers\TaskController;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_list_shows_data(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
        $response->assertViewIs('tasks.indexTask');
        $response->assertViewHas(['tasks']);
    }

    public function test_ability_to_create_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create();

        $this->assertDatabaseHas('tasks', ['title' => $task->title]);
    }

    public function test_ability_to_edit_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create();
        $task2 = Task::factory()->make();

        $this->put('tasks.update', [$task, $task2]);
        $this->assertDatabaseHas('tasks', ['title' => $task->title]);
    }

    public function test_ability_to_delete_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create();

        $task->delete();
        $this->assertDatabaseMissing('tasks', ['title' => $task->title]);
    }


    public function test_ability_to_check_if_completed(): void
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->make();
        $this->actingAs($user);

        $task = Task::factory()->create();

        $this->followingRedirects();

        $response = $this->patch(route('tasks.changeStatus', ['task' => $task]));

        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', [
           'id' => $task->id,
           'completed_at' => now()
        ]);
    }

}
