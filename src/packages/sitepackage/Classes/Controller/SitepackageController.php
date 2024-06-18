<?php

namespace Maxserv\Sitepackage\Controller;

use Psr\Http\Message\ResponseInterface;

use TYPO3\CMS\Backend\Attribute\AsController;
use TYPO3\CMS\Core\Http\ResponseFactory;

#[AsController]
class SitepackageController
{
    public function __invoke(): ResponseInterface
    {
       $factory = new ResponseFactory();
       $response = $factory->createResponse();
       $response->getBody()->write('Hello World');
       return $response;
    }
}