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
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
        $response->assertViewIs('tasks.indexTask');
        $response->assertViewHas(['tasks']);
    }

    public function test_ability_to_create_task()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'recycled' => 'no'
        ]);

        $this->assertDatabaseHas('tasks', ['title' => $task->title]);
    }

    public function test_ability_to_edit_task()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'recycled' => 'no'
        ]);
        $task2 = Task::factory()->make();

        $this->put('tasks.update', [$task, $task2]);
        $this->assertDatabaseHas('tasks', ['title' => $task->title]);
    }

    public function test_ability_to_delete_task()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'recycled' => 'no'
        ]);

        $task->delete();
        $this->assertDatabaseMissing('tasks', ['title' => $task->title]);
    }


    public function test_ability_to_check_if_completed(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'completed_at' => null,
            'recycled' => 'no'
        ]);

        $this->followingRedirects();

        $response = $this->patch(route('tasks.changeStatus', ['task' => $task]));

        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', [
           'id' => $task->id,
           'completed_at' => now(),
            'recycled' => 'no'
        ]);
    }

    public function test_ability_to_set_recycled_status(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'recycled' => 'no'
        ]);

        $this->followingRedirects();

        $response = $this->patch(route('tasks.changeRecycle', ['task' => $task]));

        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'recycled' => 'yes'
        ]);
    }
}
