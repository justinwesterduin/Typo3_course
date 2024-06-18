<?php

namespace MaxServ\Pool\Console;

use App\Services\CategoryService;
use MaxServ\Pool\Domain\Repository\GameRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'games:delete',
    description: 'Deletes all games played longer than 30 days ago',
)]
class DeleteOlderThanThirtyDaysCommand extends Command
{
    public function __construct(
        private readonly GameRepository $gameRepository,
        ?string $name = null
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->gameRepository->removeOldGames();
        $output->writeln('The old games have been deleted');

        return Command::SUCCESS;
    }
}
