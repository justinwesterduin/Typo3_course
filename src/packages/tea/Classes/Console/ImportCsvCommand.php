<?php
declare(strict_types=1);

namespace TTN\Tea\Console;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TTN\Tea\Importer\CsvImporter;
use TYPO3\CMS\Core\Core\Bootstrap;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TTN\Tea\Event\ImportCompletedEvent;
use Psr\EventDispatcher\EventDispatcherInterface;

class ImportCsvCommand extends Command
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly DataHandler $dataHandler,
        private CsvImporter $csvImporter,
        ?string $name = null
    )
    {
        parent ::__construct($name);
    }

    protected function configure()
    {
        $this->getHelp('Imports typo3 CSV');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $message = 'items have been successfully imported from the csv file';

        $data = $this->csvImporter->importCsv();
        $importData = [];
        $amount = 0;

        $progressBar = new ProgressBar($output);
        $progressBar->setBarCharacter('<fg=green>=</>');
        $progressBar->setEmptyBarCharacter("<fg=red>=</>");
        $progressBar->setProgressCharacter("<fg=green>></>");
        $progressBar->start();

        foreach ($data as $item) {
            $id = $this->csvImporter->getTeaId($item['Id']);
            $importData['tx_tea_domain_model_tea'][$id] = [
                'id' => $item['Id'],
                'title' => $item['Title'],
                'description' => $item['Description'],
                'pid' => '66',
            ];
            $progressBar->advance();
            $amount++;
        }
        Bootstrap::initializeBackendAuthentication();
        $this->dataHandler->start($importData, []);
        $this->dataHandler->process_datamap();

        $progressBar->finish();
        $output->writeln('');

        $this->logger->log(LogLevel::CRITICAL, $message, $importData);

        /** @var ImportCompletedEvent $event */
        $event = $this->eventDispatcher->dispatch(
            new ImportCompletedEvent(
                $message,
                $amount
            )
        );

        return Command::SUCCESS;
    }
}