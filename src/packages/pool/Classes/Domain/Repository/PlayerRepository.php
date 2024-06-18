<?php

namespace MaxServ\Pool\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class PlayerRepository extends Repository
{
    public function findTopThreePlayers(): array
    {
        $query = $this->createQuery();
        $query->statement(
            statement: '
            SELECT p.uid, p.name as playerName, COUNT(winner) AS wins
            FROM tx_pool_domain_model_player p
            INNER JOIN tx_pool_domain_model_game g ON winner = p.uid
            WHERE g.date >= CURRENT_DATE - INTERVAL 2 WEEK
            GROUP BY winner
            ORDER BY wins DESC
            LIMIT 3
        ');
        return $query->execute(returnRawQueryResult: true);
    }

//    public function countWins(): QueryResultInterface
//    {
//        $query = $this->createQuery();
//        $query->statement(
//            statement: '
//            SELECT p.uid, COUNT(winner) AS wins
//            FROM tx_pool_domain_model_player p
//            INNER JOIN tx_pool_domain_model_game g ON winner = p.uid
//            GROUP BY winner
//        ');
//        return $query->execute();
//    }
}