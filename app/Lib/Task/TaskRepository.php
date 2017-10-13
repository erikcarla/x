<?php
namespace App\Lib\Task;

use App\Models\Task;

class TaskRepository
{
    public function getTask()
    {
        return Task::orderBy('created_at', 'asc')->get();
    }
}
