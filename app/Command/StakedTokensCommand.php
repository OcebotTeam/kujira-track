<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\StakedTokensService;

#[AsCommand(
    name: 'app:staked-token',
    description: 'Staked token',
    hidden: false,
    aliases: ['app:staked-token']
)]

class StakedTokensCommand extends Command
{
    private $entityManager;
    private $stakedTokensService;

    public function __construct(EntityManagerInterface $entityManager, StakedTokensService $stakedTokensService)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->stakedTokensService = $stakedTokensService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Storing Staked token info',
            '============',
            '',
        ]);

        $em = $this->entityManager;
        $this->stakedTokensService->setStakedTokens($em);

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
