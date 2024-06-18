<?php
declare(strict_types=1);

namespace TTN\Tea\Controller;

use Psr\Http\Message\ResponseInterface;
use TTN\Tea\Domain\Repository\TeaRepository;
use TTN\Tea\Event\TeaTimeEvent;
use TTN\Tea\PageTitle\TeaPageTitleProvider;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TTN\Tea\Domain\Model\Tea;

class TeaController extends ActionController
{
    private TeaRepository $teaRepository;

    public function __construct(
        TeaRepository $teaRepository,
        private readonly TeaPageTitleProvider $teaPageTitleProvider
    )
    {
        $this->teaRepository = $teaRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('MaxServ', 'Waalwijk');
        $this->view->assign('teas', $this->teaRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(Tea $tea): ResponseInterface
    {
        /** @var TeaTimeEvent $event */
        $event = $this->eventDispatcher->dispatch(
            new TeaTimeEvent(
                $tea,
                new \DateTime(),
                'From the controller'
            )
        );
        $this->teaPageTitleProvider->setTitle($event->getTea());
        $this->view->assign('tea', $event->getTea());
        $this->view->assign('date', $event->getDateTime());
        $this->view->assign('comment', $event->getComment());
        return $this->htmlResponse();
    }
}