<?php
declare(strict_types=1);

namespace MaxServ\Pool\Controller;

use MaxServ\Pool\Domain\Model\Player;
use Psr\Http\Message\ResponseInterface;
use MaxServ\Pool\Domain\Repository\GameRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use MaxServ\Pool\Domain\Model\Game;

use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Core\Pagination\SlidingWindowPagination;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class GameController extends ActionController
{
    private GameRepository $gameRepository;

    public function __construct(
        GameRepository $gameRepository,
    )
    {
        $this->gameRepository = $gameRepository;
    }

    public function indexAction(int $currentPage = 1): ResponseInterface
    {
        $itemsPerPage = 5;
        $totalGames = $this->gameRepository->findAll();
        $paginator = new QueryResultPaginator(
            $totalGames,
            $currentPage,
            $itemsPerPage,
        );

        $pagination = new SimplePagination($paginator);

        $numberToStart = ($currentPage -1) * $itemsPerPage;

        $this->view->assignMultiple(
            [
                'results' => $paginator->getPaginatedItems(),
                'pagination' => $pagination,
                'currentPage' => $currentPage,
                'numberToStart' => $numberToStart
            ]
        );
        return $this->htmlResponse();
    }

    public function showAction(Game $game): ResponseInterface
    {
        $this->view->assign('game', $game);
        return $this->htmlResponse();
    }
}