<?php
declare(strict_types=1);

namespace TTN\Tea\EventListener;

use Symfony\Component\Mime\Address;
use TTN\Tea\Event\ImportCompletedEvent;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\MailerInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ImportCompletedListener
{
    public function __invoke(ImportCompletedEvent $event): void
    {
        $email = new FluidEmail();
        $email->to(
            new Address('justin.westerduin@maxserv.com', 'Justin Westerduin')
        );
        $email->setTemplate('CsvImportCompleted');
        $email->subject('CSV import');
        $email->assign('title', 'Teas.csv');
        $email->assign('message', $event->getMessage());
        $email->assign('amount', $event->getAmount());
        GeneralUtility::makeInstance(MailerInterface::class)->send($email);
    }
}