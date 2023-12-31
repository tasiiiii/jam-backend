<?php

namespace App\UI\Board\Dto\BoardReport;

class Column
{
    private int    $id;
    private string $title;
    private float  $totalStoryPoints;
    /**
     * @var Task[]
     */
    private array  $tasks;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

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
