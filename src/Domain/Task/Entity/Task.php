<?php

namespace App\Domain\Task\Entity;

class Task
{
    /**
     * @var int
     */
    private $seosprintId;
    /**
     * @var int
     */
    private $taskId;
    /**
     * @var int
     */
    private $status;

    /**
     * @return int
     */
    public function getSeosprintId(): int
    {
        return $this->seosprintId;
    }

    /**
     * @param int $seosprintId
     */
    public function setSeosprintId(int $seosprintId): void
    {
        $this->seosprintId = $seosprintId;
    }

    /**
     * @return int
     */
    public function getTaskId(): int
    {
        return $this->taskId;
    }

    /**
     * @param int $taskId
     */
    public function setTaskId(int $taskId): void
    {
        $this->taskId = $taskId;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}