<?php

namespace MaxServ\Pool\DataProcessors;

use MaxServ\Pool\Domain\Repository\PlayerRepository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

class PlayerDataProcessor implements DataProcessorInterface
{
    public function __construct(
        private PlayerRepository $playerRepository
    )
    {
    }

    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        $querysettings = $this->playerRepository->createQuery()->getQuerySettings();
        $querysettings->setRespectStoragePage(false);
        $this->playerRepository->setDefaultQuerySettings($querysettings);

        $topThree = $this->playerRepository->findTopThreePlayers();

        $variableTopThree= array_key_exists('variableName', $processorConfiguration) ? $processorConfiguration['variableName'] : 'topThreePlayers';
        $processedData[$variableTopThree] = $topThree;

        return $processedData;
    }
}