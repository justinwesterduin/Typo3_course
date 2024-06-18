<?php

namespace Maxserv\MySitepackage\Service;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\HiddenRestriction;
use TYPO3\CMS\Core\Utility\StringUtility;

class RssFeedService
{
    public function __construct(protected ConnectionPool $connectionPool)
    {
    }

    public static function getRssFeed(string $url) {
        $xml = simplexml_load_file($url);
        return $xml->xpath('//item');
    }

    public function getIdOfPageBasedOnRssGuid(string $guid): string
    {
        $qb = $this->connectionPool->getQueryBuilderForTable('pages');
        $qb->getRestrictions()
            ->removeByType(HiddenRestriction::class);
        $result = $qb->select('uid')
            ->from('pages')
            ->where(
                $qb->expr()->eq('abstract', $qb->createNamedParameter($guid))
            )
            ->executeQuery();

        if ($row = $result->fetchAssociative()) {
            return $row['uid'];
        }

        return StringUtility::getUniqueId('NEW');
    }

    public function getIdOfContentBasedOnRssGuid(string $guid): string
    {
        $qb = $this->connectionPool->getQueryBuilderForTable('tt_content');
        $qb->getRestrictions()
            ->removeByType(HiddenRestriction::class);
        $result = $qb->select('uid')
            ->from('tt_content')
            ->where(
                $qb->expr()->eq('table_class', $qb->createNamedParameter($guid))
            )
            ->executeQuery();

        if ($row = $result->fetchAssociative()) {
            return $row['uid'];
        }

        return StringUtility::getUniqueId('NEW');
    }
}