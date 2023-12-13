<?php

namespace App\Command;

use App\Service\UskMintedService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:uskminted',
    description: 'Minted USK track',
    hidden: false,
    aliases: ['app:uskminted']
)]

class UskMintedCommand extends Command
{
    private $entityManager;
    private $UskMintedService;

    public function __construct(EntityManagerInterface $entityManager, UskMintedService $UskMintedService)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->UskMintedService = $UskMintedService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Storing token info',
            '============',
            '',
        ]);

        $em = $this->entityManager;

        $this->UskMintedService->setUskMinted($em);

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
