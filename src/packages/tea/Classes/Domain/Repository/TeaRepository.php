<?php
declare(strict_types=1);

namespace TTN\Tea\Domain\Repository;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\HiddenRestriction;
use TYPO3\CMS\Core\Utility\StringUtility;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;


class TeaRepository extends Repository
{
    public function __construct
    (
        private readonly ConnectionPool $connectionPool,
    )
    {
        parent::__construct();
    }

    public function findLatest(): array
    {
        $queryBuilder = $this->connectionPool->getQueryBuilderForTable('tx_tea_domain_model_tea');
        return $queryBuilder
            ->select('title')
            ->from('tx_tea_domain_model_tea')
            ->orderBy('crdate', 'DESC')
            ->setMaxResults(1)
            ->executeQuery()
            ->fetchAllAssociative();

//        $query = $this->createQuery();
//        $query->statement('SELECT title FROM tx_tea_domain_model_tea ORDER BY crdate DESC LIMIT 1');
//        $query->execute(returnRawQueryResult: true);
//        return $query->execute(returnRawQueryResult: true)[0];
    }
}