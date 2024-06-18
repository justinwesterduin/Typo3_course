<?php
declare(strict_types=1);

namespace MaxServ\Pool\Domain\Repository;

use Doctrine\DBAL\Connection;
use MaxServ\Pool\Domain\Model\Player;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class GameRepository extends Repository
{
    private const TABLE_NAME = 'tx_pool_domain_model_game';
    public function __construct
    (
        private readonly ConnectionPool $connectionPool,
    )
    {
        parent::__construct();
    }

    public function findGamesPerPlayer(Player $player): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalOr(
                $query->equals('player1', $player),
                $query->equals('player2', $player)
            )
        );
        return $query->execute();
    }

    public function findLastGames(): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->setOrderings(['date' => 'DESC']);
        $query->setLimit(5);

        return $query->execute();
    }

    public function findGamePerDayPlayer(Player $player): array
    {
        $query = "
            SELECT DATE(FROM_UNIXTIME(date)) AS d, COUNT(*) AS games
            FROM tx_pool_domain_model_game
            WHERE (player1 = :player OR player2 = :player)
            AND date >= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 30 DAY))
            GROUP BY d
        ";
        $queryBuilder = $this->connectionPool->getConnectionForTable(self::TABLE_NAME);
        return $queryBuilder
            ->executeQuery($query, ['player' => $player->getUid()])
            ->fetchAllAssociative();
    }

    public function removeOldGames(): void
    {
        $query = $this->createQuery();
        $query->statement('DELETE FROM tx_pool_domain_model_game WHERE date < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 30 DAY))');
        $query->execute(returnRawQueryResult: true);
    }
}