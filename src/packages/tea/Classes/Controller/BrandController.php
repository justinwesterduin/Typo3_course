<?php

namespace TTN\Tea\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TTN\Tea\Domain\Model\Brand;

class BrandController extends ActionController
{
    public function showAction(Brand $brand): ResponseInterface
    {
        $this->view->assign('brand', $brand);
        return $this->htmlResponse();
    }
}