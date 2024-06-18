<?php

declare(strict_types=1);

namespace TTN\Tea\Controller;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use TTN\Tea\Event\TeaMessageEvent;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Http\ResponseFactory;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

use TYPO3\CMS\Core\Messaging\FlashMessageQueue;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;

final readonly class BackendController {

    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @param ResponseFactory $factory
     * @param ModuleTemplateFactory $factory
     */
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly ResponseFactory $factory,
        private readonly UriBuilder $uriBuilder,
        private readonly FlashMessageService $flashMessageService,
    ) {
    }
    public function buttonClicked(RequestInterface $request): void
    {
        $data = [];
        $data['title'] = $_POST['title'];

        $message = 'A new tea has been created!';

        if(!empty($_POST)) {
            /** @var TeaMessageEvent $event */
            $event = $this->eventDispatcher->dispatch(
                new TeaMessageEvent(
                    $message,
                    $data,
                )
            );
        }
        $this->createAndStoreFlashMessage($message);
        $this->callDashboardController();
    }

    public function callDashboardController(): void
    {
        $uri = $this->uriBuilder->buildUriFromRoute(
            'dashboard'
        );
        header('location: ' . $uri);
        exit();
    }

    public function createAndStoreFlashMessage($message)
    {
        $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
        $notificationQueue = $flashMessageService->getMessageQueueByIdentifier(
            FlashMessageQueue::NOTIFICATION_QUEUE
        );

        $flashMessage = new FlashMessage(
            $message, // The message body
            'Success', // The message title
            ContextualFeedbackSeverity::OK, // The severity level
            true // Store the message in the session
        );

        $notificationQueue->enqueue($flashMessage);
    }
}