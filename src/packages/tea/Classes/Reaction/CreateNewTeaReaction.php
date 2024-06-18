<?php

namespace TTN\Tea\Reaction;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use TTN\Tea\Domain\Repository\TeaRepository;
use TYPO3\CMS\Core\Core\Bootstrap;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\HiddenRestriction;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\Exception\MissingArrayPathException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;
use TYPO3\CMS\Reactions\Model\ReactionInstruction;
use TYPO3\CMS\Reactions\Reaction\ReactionInterface;
use TYPO3\CMS\Reactions\Validation\CreateRecordReactionTable;
use TYPO3\CMS\Reactions\Authentication\ReactionUserAuthentication;
use TTN\Tea\Importer\CsvImporter;

class CreateNewTeaReaction implements ReactionInterface
{
    public function __construct(
        private readonly ResponseFactoryInterface $responseFactory,
        private readonly StreamFactoryInterface $streamFactory,
        private readonly ConnectionPool $connectionPool,
        private readonly LoggerInterface $logger,
    )
    {
    }

    /**
     * @inheritDoc
     */
    public static function getType(): string
    {
        return 'tea-create_new';
    }

    /**
     * @inheritDoc
     */
    public static function getDescription(): string
    {
        return 'Create a new tea record';
    }

    /**
     * @inheritDoc
     */
    public static function getIconIdentifier(): string
    {
        return 'actions-plus-badge';
    }

    /**
     * @inheritDoc
     */
    public function react(
        ServerRequestInterface $request,
        array $payload,
        ReactionInstruction $reaction
    ): ResponseInterface {

        $this->logger->log(LogLevel::NOTICE, 'New call to this reaction.');

        $table = (string)($reaction->toArray()['table_name'] ?? '');
        $fields = (array)($reaction->toArray()['fields'] ?? []);

        if (!(new CreateRecordReactionTable($table))->isAllowedForCreation()) {
            $response = new jsonResponse(['success' => false, 'error' => 'Invalid argument "table_name"'], 400);
            $this->logger->log(LogLevel::ERROR, 'Invalid argument "table_name"');
            return $response;
        }

        if ($fields === []) {
            $response = new jsonResponse(['success' => false, 'error' => 'No fields given.'], 400);
            $this->logger->log(LogLevel::ERROR, 'No fields given.');
            return $response;
        }

        if ($fields['title'] == '' || $fields['title'] == [] || $fields['title'] == null) {
            $response = new jsonResponse(['success' => false, 'error' => 'All fields are empty.'], 400);
            $this->logger->log(LogLevel::ERROR, 'All reaction fields are empty.');
            return $response;
        }

        $dataHandlerData = [];
        foreach ($fields as $fieldName => $value) {
            $dataHandlerData[$fieldName] = $this->replacePlaceHolders($value, $payload);
        }
        $dataHandlerData['pid'] = 66;

        $data[$table][$this->checkTeaId($dataHandlerData['title'])] = $dataHandlerData;
        $dataHandler = new DataHandler;
        $dataHandler->start($data, [], $this->getBackendUser());
        $dataHandler->process_datamap();
        return $this->buildResponseFromDataHandler($dataHandler, 201);
    }

    public function replacePlaceHolders(mixed $value, array $payload): string
    {
        if (is_string($value)) {
            $re = '/\$\{([^\}]*)\}/m';
            preg_match_all($re, $value, $matches, PREG_SET_ORDER, 0);
            foreach ($matches as $match) {
                try {
                    $value = str_replace($match[0], (string)ArrayUtility::getValueByPath($payload, $match[1], '.'), $value);
                } catch (MissingArrayPathException) {
                    // Ignore this exception to show the user that there was no placeholder in the payload
                }
            }
        }
        return $value;
    }

    protected function buildResponseFromDataHandler(DataHandler $dataHandler, int $successCode = 200): ResponseInterface
    {
        // Success depends on whether at least one NEW id has been substituted
        $success = $dataHandler->substNEWwithIDs !== [] && $dataHandler->substNEWwithIDs_table !== [];

        $statusCode = $successCode;
        $data = [
            'success' => $success,
        ];

        if (!$success) {
            $statusCode = 400;
            $data['error'] = 'Record could not be created';
            $this->logger->log(LogLevel::ERROR, $data['error']);
        }
        return $this->jsonResponse($data, $statusCode);
    }

    protected function jsonResponse(array $data, int $statusCode = 200): ResponseInterface
    {
        return $this->responseFactory
            ->createResponse($statusCode)
            ->withHeader('Content-Type', 'application/json')
            ->withBody($this->streamFactory->createStream((string)json_encode($data)));
    }

    private function getBackendUser(): ReactionUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }

    public function checkTeaId(string $title): string
    {
        $queryBuilder = $this->connectionPool->getQueryBuilderForTable('tx_tea_domain_model_tea');
        $queryBuilder->getRestrictions()
            ->removeByType(HiddenRestriction::class);
        $result = $queryBuilder->select('uid')
            ->from('tx_tea_domain_model_tea')
            ->where(
                $queryBuilder->expr()->eq('title', $queryBuilder->createNamedParameter($title))
            )
            ->executeQuery();
        if ($row = $result->fetchAssociative()) {
            return (string)$row['uid'];
        }
        return StringUtility::getUniqueId('NEW');
    }
}