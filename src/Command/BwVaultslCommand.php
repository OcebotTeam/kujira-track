<?php

namespace App\Command;

use App\Service\BwVaultsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:bw_vaults',
    description: 'Store bw_vaults status',
    hidden: false,
    aliases: ['app:bw_vaults']
)]

class BwVaultslCommand extends Command
{
    private $entityManager;
    private $BwVaultsService;


    public function __construct(EntityManagerInterface $entityManager, BwVaultsService $BwVaultsService)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->BwVaultsService = $BwVaultsService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Storing Bw info',
            '============',
            '',
        ]);

        $em = $this->entityManager;

        $this->BwVaultsService->setBwVaultsService($em);

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
