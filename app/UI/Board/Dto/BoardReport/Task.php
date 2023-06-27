<?php

namespace App\UI\Board\Dto\BoardReport;

class Task
{
    private string  $title;
    private string  $code;
    private ?float  $storyPoint = null;
    private string  $creator;
    private ?string $executor = null;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCreator(): string
    {
        return $this->creator;
    }

    public function setCreator(string $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    public function getExecutor(): ?string
    {
        return $this->executor;
    }

    public function setExecutor(?string $executor): self
    {
        $this->executor = $executor;

        return $this;
    }

    public function getStoryPoint(): ?float
    {
        return $this->storyPoint;
    }

    public function setStoryPoint(?float $storyPoint): self
    {
        $this->storyPoint = $storyPoint;

        return $this;
    }
}
