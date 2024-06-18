<?php
declare(strict_types=1);

namespace TTN\Tea\Importer;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\HiddenRestriction;
use TYPO3\CMS\Core\Utility\StringUtility;

class CsvImporter
{
    public function __construct(protected ConnectionPool $connectionPool)
    {
    }

    public function importCsv(): array
    {
        $csv = fopen('Teas.csv', 'r');
        $csvArray = [];
        $header = fgetcsv($csv, 0, ";");
        while (($data = fgetcsv($csv, 0, ";")) !== FALSE) {
            $csvArray[] = array_combine($header, $data);
            }
        fclose($csv);
        return $csvArray;
    }

    public function getTeaId(string $id): string
    {
        $queryBuilder = $this->connectionPool->getQueryBuilderForTable('tx_tea_domain_model_tea');
        $queryBuilder->getRestrictions()
            ->removeByType(HiddenRestriction::class);
        $result = $queryBuilder->select('uid')
            ->from('tx_tea_domain_model_tea')
            ->where(
                $queryBuilder->expr()->eq('id', $queryBuilder->createNamedParameter($id))
            )
            ->executeQuery();
        if ($row = $result->fetchAssociative()) {
            return (string)$row['uid'];
        }
        return StringUtility::getUniqueId('NEW');
    }
}