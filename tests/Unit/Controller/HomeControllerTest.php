<?php
namespace App\Http\Controllers;

use App\Lib\Task\Service\CreateTask;
use App\Lib\Task\Service\DeleteTask;
use App\Lib\Task\TaskRepository;
use App\Models\Task;

use Mockery;
use App;

class HomeControllerTest extends \ControllerTest
{
    public function test_index()
    {
        $mockTask = Mockery::mock(TaskRepository::class)->makePartial();
        $mockTask->shouldReceive('getTask')->once()->andReturn(collect());
        App::instance(TaskRepository::class, $mockTask);

        $path = route('home.get');
        $response = $this->call('GET', $path);

        $response->assertStatus(200);
        $response->assertViewHas('tasks');
        $this->assertEquals('tasks', $response->original->getName());
    }

    public function test_store()
    {
        $task = factory(Task::class)->create();
        $validInputs = array_except($task->getAttributes(), ['updated_at', 'created_at']);

        $mockTask = Mockery::mock(CreateTask::class)->makePartial();
        $mockTask->shouldReceive('run')->once()->andReturn('asd');
        App::instance(CreateTask::class, $mockTask);

        $path = route('task.store');
        $response = $this->post($path, $validInputs);

        $response->assertRedirect('/home');
    }
}
