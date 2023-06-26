<?php

namespace App\Jam\BoardColumn\Action;

use App\Jam\Auth\Service\UserProviderInterface;
use App\Jam\Board\Repository\BoardRepositoryInterface;
use App\Jam\BoardColumn\Contract\BoardColumnCreateDataInterface;
use App\Jam\BoardColumn\Gate\BoardColumnCreateGate;
use App\Jam\Exception\ApplicationException;
use App\Jam\User\Service\UserStatusChecker;
use App\Models\BoardColumn;

class BoardColumnCreateAction
{
    public function __construct(
        private readonly BoardRepositoryInterface $boardRepository,
        private readonly BoardColumnCreateGate    $boardColumnCreateGate,
        private readonly UserStatusChecker        $userStatusChecker,
        private readonly UserProviderInterface    $userProvider
    )
    {}

    /**
     * @throws ApplicationException
     */
    public function run(BoardColumnCreateDataInterface $data): void
    {
        $currentUser = $this->userProvider->getCurrentUser();
        $this->userStatusChecker->check($currentUser);

        $board = $this->boardRepository->getById($data->getBoardId());
        if (is_null($board)) {
            throw new ApplicationException('Board not found');
        }

        $this->boardColumnCreateGate->can($currentUser, $board);

        $boardColumn           = new BoardColumn();
        $boardColumn->title    = $data->getTitle();
        $boardColumn->board_id = $board->id;
        $boardColumn->save();
    }
}
