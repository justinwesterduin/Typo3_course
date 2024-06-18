<?php
declare(strict_types=1);

namespace MaxServ\Pool\Controller;

use Psr\Http\Message\ResponseInterface;
use MaxServ\Pool\Domain\Model\Player;
use MaxServ\Pool\Domain\Repository\GameRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class PlayerController extends ActionController
{
    public function __construct(protected GameRepository $gameRepository)
    {
    }
    public function showAction(Player $player): ResponseInterface
    {
        $games = $this->gameRepository->findGamesPerPlayer($player);
        $gamesPerDay = $this->gameRepository->findGamePerDayPlayer($player);

        $arr = [];

        DebuggerUtility::var_dump($gamesPerDay);

        for ($i = 0; $i <= 30; $i++) {
            $date = date('Y-m-d', strtotime('-'.$i.' days'));
            foreach($gamesPerDay as $game) {
                if ($date === $game['d']) {
                    $arr[] = $game;
                } else {
                    $arr[] = ['d' => $date, 'games' => 0];
                }
            }
        }

        $this->view->assignMultiple([
            'player' => $player,
            'games' => $games,
            'playedGames' => $arr
        ]);
        return $this->htmlResponse();
    }
}