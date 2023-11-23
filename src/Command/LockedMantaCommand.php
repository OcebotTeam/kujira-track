<?php

namespace App\Command;

use App\Service\LockedMantaService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;



#[AsCommand(
    name: 'app:locked-manta',
    description: 'Locked token',
    hidden: false,
    aliases: ['app:Locked-manta']
)]

class LockedMantaCommand extends Command
{

    private $entityManager;
    private $lockedMantaService;

        public function __construct(EntityManagerInterface $entityManager, LockedMantaService $lockedMantaService )
    {
       parent::__construct();
        $this->entityManager = $entityManager;
        $this->lockedMantaService = $lockedMantaService;
    }

    protected function execute(InputInterface $input, OutputInterface $output):int
    {
        $output->writeln([
            'Storing Staked token info',
            '============',
            '',
        ]);

        $em = $this->entityManager;
        $this->lockedMantaService->setLockedTokens($em);

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