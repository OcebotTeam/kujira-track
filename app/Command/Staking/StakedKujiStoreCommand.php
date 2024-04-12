<?php

namespace App\Command\Staking;

use Ocebot\KujiraTrack\Staking\Application\StakedKujiRequester;
use Ocebot\KujiraTrack\Staking\Application\StakedKujiStorer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'kt:staking:store',
    description: 'Store kuji staking current status',
    hidden: false,
    aliases: ['kt:staking:store']
)]

class StakedKujiStoreCommand extends Command
{
    public function __construct(
        private readonly StakedKujiRequester $stakedKujiRequester,
        private readonly StakedKujiStorer $stakedKujiStorer,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $stakedKuji = $this->stakedKujiRequester->__invoke();

        $this->stakedKujiStorer->__invoke(
            $stakedKuji['time'],
            $stakedKuji['value'],
            $stakedKuji['notBondedTokens']
        );

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->setHelp('Stores the current staking status of kuji tokens');
    }
}
