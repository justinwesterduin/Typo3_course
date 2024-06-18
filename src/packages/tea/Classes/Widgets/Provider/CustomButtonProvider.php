<?php

declare(strict_types=1);

namespace TTN\Tea\Widgets\Provider;

use TYPO3\CMS\Backend\Routing\Exception\RouteNotFoundException;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Dashboard\Widgets\Provider\ButtonProvider;

class CustomButtonProvider extends ButtonProvider {

    public function __construct(
        private readonly UriBuilder $uriBuilder,
        string $title,
        public readonly string $routeIdentifier,
        private readonly string $link = '',
        string $target = ''
    ) {
        parent::__construct($title, $link, $target);
    }

    /**
     * @throws RouteNotFoundException
     */
    #[\Override] public function getLink(): string
    {
        return (string)$this->uriBuilder->buildUriFromRoute($this->routeIdentifier);
    }
}