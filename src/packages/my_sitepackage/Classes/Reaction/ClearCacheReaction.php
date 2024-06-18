<?php

namespace Maxserv\MySitepackage\Reaction;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Reactions\Model\ReactionInstruction;
use TYPO3\CMS\Reactions\Reaction\ReactionInterface;

class ClearCacheReaction implements ReactionInterface
{
    public function __construct(private readonly FrontendInterface $cache)
    {
    }

    /**
     * @inheritDoc
     */
    public static function getType(): string
    {
        return 'mysitepackage-clear_cache';
    }

    /**
     * @inheritDoc
     */
    public static function getDescription(): string
    {
        return 'Flush cache';
    }

    /**
     * @inheritDoc
     */
    public static function getIconIdentifier(): string
    {
        return 'actions-system-cache-clear';
    }

    /**
     * @inheritDoc
     */
    public function react(
        ServerRequestInterface $request,
        array $payload,
        ReactionInstruction $reaction
    ): ResponseInterface {
        $this->cache->flush();
        return New JsonResponse(['success', true]);
    }
}