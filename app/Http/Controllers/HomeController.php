<?php

namespace App\Http\Controllers;

use App\Lib\Task\Service\CreateTask;
use App\Lib\Task\Service\DeleteTask;
use App\Http\Requests\TaskRequest;
use App\Lib\Task\TaskRepository;
use App\Models\Task;

use Validator;
use App;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = App::make(TaskRepository::class)->getTask();

        return view('tasks', [
            'tasks' => $tasks
        ]);
    }

    public function store(TaskRequest $request)
    {
        $task = new CreateTask($this->params());
        $task->run();

        return redirect('/home');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        $deleteTask = new DeleteTask($task);
        $deleteTask->run();

        return redirect('/home');
    }

    private function params()
    {
        return request()->only([
            'name'
        ]);
    }

}
