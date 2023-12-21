<?php

namespace App\Command;

use App\Service\GhostBorrowedService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:ghost_borrowed',
    description: 'Ghost borrowed tokens',
    hidden: false,
    aliases: ['app:ghost_borrowed']
)]

class GhostBorrowedCommand extends Command
{
    private $entityManager;
    private $GhostBorrowedService;

    public function __construct(EntityManagerInterface $entityManager, GhostBorrowedService $GhostBorrowedService)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->GhostBorrowedService = $GhostBorrowedService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Storing token info',
            '============',
            '',
        ]);

        $em = $this->entityManager;

        $this->GhostBorrowedService->setGhostBorrowed($em);

        $output->writeln([
            'Done!',
            '============',
            '',
        ]);

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            // the command help shown when running the command with the "--help" option
            ->setHelp('This command store the token information')
        ;
    }

}
