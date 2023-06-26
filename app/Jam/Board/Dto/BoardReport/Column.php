<?php

namespace App\Jam\Board\Dto\BoardReport;

class Column
{
    private string $title;
    private float  $totalStoryPoints;
    /**
     * @var Task[]
     */
    private array  $tasks;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTotalStoryPoints(): float
    {
        return $this->totalStoryPoints;
    }

    public function setTotalStoryPoints(float $totalStoryPoints): self
    {
        $this->totalStoryPoints = $totalStoryPoints;

        return $this;
    }

    /**
     * @return Task[]
     */
    public function getTasks(): array
    {
        return $this->tasks;
    }

    /**
     * @param Task[] $tasks
     * @return $this
     */
    public function setTasks(array $tasks): self
    {
        $this->tasks = $tasks;

        return $this;
    }
}
