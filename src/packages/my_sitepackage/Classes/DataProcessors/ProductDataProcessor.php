<?php

namespace Maxserv\MySitepackage\DataProcessors;

use TTN\Tea\Domain\Repository\TeaRepository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

class ProductDataProcessor implements DataProcessorInterface
{
    public function __construct(protected TeaRepository $teaRepository)
    {
    }

    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        $querysettings = $this->teaRepository->createQuery()->getQuerySettings();
        $querysettings->setRespectStoragePage(false);
        $this->teaRepository->setDefaultQuerySettings($querysettings);
        $product = [
          'name' => 'product',
          'price' => 10
        ];

        $variableName = array_key_exists('variableName', $processorConfiguration) ? $processorConfiguration['variableName'] : 'variable';
        $processedData[$variableName] = $this->teaRepository->findAll();

        return $processedData;
    }
}