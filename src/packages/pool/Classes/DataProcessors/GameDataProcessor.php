<?php

namespace MaxServ\Pool\DataProcessors;

use MaxServ\Pool\Domain\Model\Player;
use MaxServ\Pool\Domain\Repository\GameRepository;

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

class GameDataProcessor implements DataProcessorInterface
{
    public function __construct(
        private GameRepository $gameRepository,
    )
    {
    }

    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        $querysettings = $this->gameRepository->createQuery()->getQuerySettings();
        $querysettings->setRespectStoragePage(false);
        $this->gameRepository->setDefaultQuerySettings($querysettings);
        $lastGames = $this->gameRepository->findLastGames();


        $variableLastGames = array_key_exists('lastGames', $processorConfiguration) ? $processorConfiguration['lastGames'] : 'lastFiveGames';
        $processedData[$variableLastGames] = $lastGames;

        return $processedData;
    }
}