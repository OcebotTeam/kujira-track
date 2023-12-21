<?php

namespace App\Command;

use App\Service\WalletsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:wallets',
    description: 'Store wallets',
    hidden: false,
    aliases: ['app:wallets']
)]

class WalletsCommand extends Command
{
    private $entityManager;
    private $WalletsService;

    public function __construct(EntityManagerInterface $entityManager, WalletsService $WalletsService)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->WalletsService = $WalletsService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Storing token info',
            '============',
            '',
        ]);

        $em = $this->entityManager;

        $this->WalletsService->setWallets($em);

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
