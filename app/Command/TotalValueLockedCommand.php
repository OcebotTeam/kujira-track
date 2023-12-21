<?php

namespace App\Command;

use App\Service\TotalValueLockedService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:tvl',
    description: 'Store Total Value locked',
    hidden: false,
    aliases: ['app:tvl']
)]

class TotalValueLockedCommand extends Command
{
    private $entityManager;
    private $TotalValueLockedService;


    public function __construct(EntityManagerInterface $entityManager, TotalValueLockedService $TotalValueLockedService)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->TotalValueLockedService = $TotalValueLockedService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Storing token info',
            '============',
            '',
        ]);

        $em = $this->entityManager;

        $this->TotalValueLockedService->setTotalValueLocked($em);

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
