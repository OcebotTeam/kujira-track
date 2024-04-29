<?php

namespace Ocebot\KujiraTrack\App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\App\Repository\LiquidationsRepository;
use Ocebot\KujiraTrack\App\Service\LiquidationsService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:liquidations',
    description: 'Minted USK track',
    hidden: false,
    aliases: ['app:liquidations']
)]

class LiquidationsCommand extends Command
{
    private $entityManager;
    private $LiquidationService;

    public function __construct(EntityManagerInterface $entityManager, LiquidationsService $LiquidationService, LiquidationsRepository $liquidationsRepository)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->LiquidationService = $LiquidationService;
        $this->LiquidationRepository = $liquidationsRepository;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Storing token info',
            '============',
            '',
        ]);

        $em = $this->entityManager;

        $this->LiquidationService->setLiquidations($em, $this->LiquidationRepository);

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
