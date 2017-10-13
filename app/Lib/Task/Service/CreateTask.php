<?php
namespace App\Lib\Task\Service;

use App\Models\Task;

class CreateTask
{
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function run()
    {
        $task = new Task();
        $task->fill($this->params);
        $task->save();

        return $task;
    }
}
