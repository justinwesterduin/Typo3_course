<?php

namespace TTN\Tea\Widgets;

use Psr\Http\Message\ServerRequestInterface;
use TTN\Tea\Domain\Repository\TeaRepository;
use TYPO3\CMS\Backend\View\BackendViewFactory;
use TYPO3\CMS\Core\SysLog\Action\Cache;
use TYPO3\CMS\Dashboard\Widgets\ButtonProviderInterface;
use TYPO3\CMS\Dashboard\Widgets\RequestAwareWidgetInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility as DebuggerUtilityAlias;

class LatestTeaWidget implements WidgetInterface, RequestAwareWidgetInterface
{
    private ServerRequestInterface $request;

    public function __construct(
        private readonly WidgetConfigurationInterface $configuration,
        private readonly TeaRepository $teaRepository,
        private readonly BackendViewFactory $backendViewFactory,
        private readonly ?ButtonProviderInterface $buttonProvider = null,
        private readonly array $options = []
    ) {
    }

    public function setRequest(ServerRequestInterface $request): void
    {
        $this->request = $request;
    }

    public function renderWidgetContent(): string
    {
        $view = $this->backendViewFactory->create($this->request);
        $view->assignMultiple([
            'teas' => $this->getLatestTea(),
            'options' => $this->options,
            'button' => $this->buttonProvider,
            'configuration' => $this->configuration,
        ]);
        return $view->render('Widget/LatestTeaWidget');
    }

    protected function getLatestTea(): array
    {
        return $this->teaRepository->findLatest();
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
