<?php

namespace App\Models;

class Task
{
    private string $task;
    private string $content;

    public function __construct(string $task, string $content)
    {
        $this->task = $task;
        $this->content = $content;
    }

    public function getTask(): string
    {
        return $this->task;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
