<?php

namespace Ocebot\KujiraTrack\App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\App\Service\UnmigratedService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:unmigrated',
    description: 'Unmigrated tokens evolution',
    hidden: false,
    aliases: ['app:unmigrated']
)]

class UnmigratedCommand extends Command
{
    private $entityManager;
    private $UnmigratedService;

    public function __construct(EntityManagerInterface $entityManager, UnmigratedService $UnmigratedService)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->UnmigratedService = $UnmigratedService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Storing token info',
            '============',
            '',
        ]);

        $em = $this->entityManager;

        $this->UnmigratedService->setUnmigrated($em);

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
            ->setHelp('This command store the unmigrated tokens information')
        ;
    }

}
