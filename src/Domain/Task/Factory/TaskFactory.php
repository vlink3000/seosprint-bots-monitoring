<?php

namespace App\Domain\Task\Factory;

use App\Application\Helpers\Validator\TaskValidator;
use App\Domain\Task\Entity\Task;
use Symfony\Component\HttpFoundation\Request;

class TaskFactory
{
    /**
     * @param Request $request
     *
     * @return Task
     */
    public function createFromRequest(Request $request): Task
    {
        $validator = new TaskValidator();
        $validatedTask = $validator->validateTaskData($request);

        $task = new Task();

        $task->setSeosprintId($validatedTask['seosprintId']);
        $task->setTaskId($validatedTask['taskId']);
        $task->setStatus($validatedTask['status']);

        return $task;
    }
}