<?php
declare(strict_types=1);

namespace MaxServ\Bug\Controller;

use MaxServ\Bug\Domain\Model\Bug;
use MaxServ\Bug\Domain\Repository\BugRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class BugController extends ActionController
{
    private BugRepository $bugRepository;
    public function __construct(BugRepository $bugRepository)
    {
        $this->bugRepository = $bugRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('bugs', $this->bugRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Bug $bug): ResponseInterface
    {
        $this->view->assign('bug', $bug);
        return $this->htmlResponse();
    }
}
