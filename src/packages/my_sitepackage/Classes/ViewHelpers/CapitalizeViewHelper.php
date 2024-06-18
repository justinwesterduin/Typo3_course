<?php
declare(strict_types=1);

namespace Maxserv\MySitepackage\ViewHelpers;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class CapitalizeViewHelper extends AbstractViewHelper
{
    protected $escapeOutput = false;
    public function initializeArguments()
    {
        $this->registerArgument('wordToCapitalize', 'string', 'Word to Capitalize', false);
        $this->registerArgument('value', 'string', 'Value to handle', false);
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $value = $arguments['value'] ?: $renderChildrenClosure();

        if ($arguments['wordToCapitalize']) {
            $value = str_replace($arguments['wordToCapitalize'], 'JJJ', $value);
        }
        return $value;
    }
}