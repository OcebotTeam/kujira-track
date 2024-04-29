<?php

namespace Ocebot\KujiraTrack\App\Command;

use App\Service\TotalValueLockedService;
use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\App\Service\TransactionsService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:transactions',
    description: 'Store transactions',
    hidden: false,
    aliases: ['app:transactions']
)]

class TransactionsCommand extends Command
{
    private $entityManager;
    private $TransactionsService;


    public function __construct(EntityManagerInterface $entityManager, TransactionsService $TransactionsService)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->TransactionsService = $TransactionsService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Storing token info',
            '============',
            '',
        ]);

        $em = $this->entityManager;

        $this->TransactionsService->setTransactions($em);

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
