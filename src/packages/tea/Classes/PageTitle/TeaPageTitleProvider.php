<?php

namespace TTN\Tea\PageTitle;

use TTN\Tea\Domain\Model\Tea;
use TYPO3\CMS\Core\PageTitle\AbstractPageTitleProvider;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class TeaPageTitleProvider extends AbstractPageTitleProvider
{
    public function __construct(private readonly SiteFinder $siteFinder)
    {
    }

    public function setTitle(Tea $tea)
    {
        DebuggerUtility::var_dump($this->getTypoScriptFrontendController()->getSite());
        $this->title = $tea->getTitle();
    }

    public function getTypoScriptFrontendController(): TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'];
    }
}