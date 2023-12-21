<?php

namespace App\Command;

use App\Service\BowTvlService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:bow_tvl',
    description: 'Store bw_vaults status',
    hidden: false,
    aliases: ['app:bow_tvl']
)]

class BowTVLCommand extends Command
{
    private $entityManager;
    private $BowTvlService;


    public function __construct(EntityManagerInterface $entityManager, BowTvlService $BowTvlService)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->BowTvlService = $BowTvlService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Storing Bow info',
            '============',
            '',
        ]);

        $em = $this->entityManager;

        $this->BowTvlService->setBowTvlService($em);

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
