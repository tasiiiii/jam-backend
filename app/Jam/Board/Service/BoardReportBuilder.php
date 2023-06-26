<?php

namespace App\Jam\Board\Service;

use App\Jam\Board\Dto\BoardReport\BoardReport;
use App\Jam\Board\Dto\BoardReport\Column;
use App\Jam\Board\Repository\BoardColumnRepositoryInterface;
use App\Models\Board;
use App\Models\BoardColumn;

class BoardReportBuilder
{
    public function __construct(
        private readonly BoardColumnRepositoryInterface $boardColumnRepository
    )
    {}

    public function build(Board $board): BoardReport
    {
        $boardColumns = $this->boardColumnRepository->getByBoard($board);

        $boardReport = new BoardReport();
        $boardReport->setTitle($board->title);

        $columns = [];
        /** @var BoardColumn $boardColumn */
        foreach ($boardColumns as $boardColumn) {
            $columns[] = (new Column())
                ->setTitle($boardColumn->title)
                ->setTotalStoryPoints(1)
                ->setTasks([]);
        }

        $boardReport->setColumns($columns);

        return $boardReport;
    }
}
