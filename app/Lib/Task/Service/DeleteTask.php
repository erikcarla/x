<?php
namespace App\Lib\Task\Service;

use App\Models\Task;

class DeleteTask
{
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function run()
    {
        $this->task->delete();
    }
}
