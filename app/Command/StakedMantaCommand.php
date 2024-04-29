<?php

namespace Ocebot\KujiraTrack\App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\App\Service\StakedMantaService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:staked-manta',
    description: 'Staked token',
    hidden: false,
    aliases: ['app:staked-manta']
)]

class StakedMantaCommand extends Command
{
    private $entityManager;
    private $stakedMantaService;

    public function __construct(EntityManagerInterface $entityManager, StakedMantaService $stakedMantaService)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->stakedMantaService = $stakedMantaService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Storing Staked token info',
            '============',
            '',
        ]);

        $em = $this->entityManager;
        $this->stakedMantaService->setStakedTokens($em);

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
