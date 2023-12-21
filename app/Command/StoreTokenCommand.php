<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\TotalValueLockedService;

#[AsCommand(
    name: 'app:store-token',
    description: 'Store token list information',
    hidden: false,
    aliases: ['app:store-token']
)]

class StoreTokenCommand extends Command
{
    private $entityManager;
    private $storedTokenService;


    public function __construct(EntityManagerInterface $entityManager, TotalValueLockedService $storedTokenService)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->storedTokenService = $storedTokenService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Storing token info',
            '============',
            '',
        ]);

        $em = $this->entityManager;

        $this->storedTokenService->setStoredTokens($em);

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
