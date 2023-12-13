<?php

namespace App\Command;

use App\Service\GhostDepositService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:ghost_deposit',
    description: 'Deposited ',
    hidden: false,
    aliases: ['app:ghost_deposit']
)]

class GhostDepositCommand extends Command
{
    private $entityManager;
    private $ghostDepositService;

    public function __construct(EntityManagerInterface $entityManager, GhostDepositService $ghostDepositService)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->ghostDepositService = $ghostDepositService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Storing token info',
            '============',
            '',
        ]);

        $em = $this->entityManager;

        $this->ghostDepositService->setGhostDeposit($em);

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
