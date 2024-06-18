<?php

namespace MaxServ\Pool\ViewHelpers;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class VowelNumberViewHelper extends AbstractViewHelper
{
    protected $escapeOutput = false;

    public function initializeArguments()
    {
        $this->registerArgument('vowelToNumber', 'string', 'Vowels to numbers', false);
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $word = $arguments['vowelToNumber'] ?: $renderChildrenClosure();
        $vowel = ["a", "e", "i", "o", "u", "A", "E", "I", "O", "U"];
        $number = random_int(1,9);
        $vowelNumber = str_replace($vowel, $number, $word);

        return $vowelNumber;
    }
}