<?php

namespace Ocebot\KujiraTrack\App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\App\Service\CommunityPoolService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:community_pool',
    description: 'Store community pool info',
    hidden: false,
    aliases: ['app:community_pool']
)]

class CommunityPoolCommand extends Command
{
    private $entityManager;
    private $CommunityPoolService;


    public function __construct(EntityManagerInterface $entityManager, CommunityPoolService $TotalValueLockedService)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->CommunityPoolService = $TotalValueLockedService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Storing token info',
            '============',
            '',
        ]);

        $em = $this->entityManager;

        $this->CommunityPoolService->setCommunityPoolInfo($em);

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
