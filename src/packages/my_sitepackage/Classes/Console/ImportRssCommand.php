<?php
declare(strict_types=1);

namespace Maxserv\MySitepackage\Console;

use Maxserv\MySitepackage\Service\RssFeedService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Core\Bootstrap;
use TYPO3\CMS\Core\DataHandling\DataHandler;

class ImportRssCommand extends Command
{
    private DataHandler $dataHandler;
    private RssFeedService $rssFeedService;

    public function __construct(DataHandler $dataHandler, RssFeedService $rssFeedService, ?string $name = null)
    {
        parent ::__construct($name);
        $this->dataHandler = $dataHandler;
        $this -> rssFeedService = $rssFeedService;
    }

    protected function configure()
    {
        $this->getHelp('Imports typo3 RSS');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = RssFeedService::getRssFeed('https://typo3.org/rss');
        $dataImport = [];

        foreach ($data as $item) {
            $id = $this->rssFeedService->getIdOfPageBasedOnRssGuid((string)$item->guid);
            $dataImport['pages'][$id] = [
                'title' => $item->title,
                'abstract' => $item->guid,
                'description' => $item->description,
                'pid' => '80'
            ];
            $contentId = $this->rssFeedService->getIdOfContentBasedOnRssGuid((string)$item->guid);
            $dataImport['tt_content'][$contentId] = [
                'header' => $item->title,
                'CType' => 'text',
                'pid' => $id,
                'table_class' => $item->guid,
                'bodytext' => (string)$item->description
            ];
        }
        Bootstrap::initializeBackendAuthentication();

        $this->dataHandler->start($dataImport, []);
        $this->dataHandler->process_datamap();
        BackendUtility::setUpdateSignal('updatePageTree');
        Return Command::SUCCESS;
    }
}