<?php

namespace App\Command\Wallets;

use Ocebot\KujiraTrack\Staking\Application\StakedKujiRequester;
use Ocebot\KujiraTrack\Staking\Application\StakedKujiStorer;
use Ocebot\KujiraTrack\Wallets\Application\WalletsRequester;
use Ocebot\KujiraTrack\Wallets\Application\WalletsStorer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'kt:wallets:store',
    description: 'Wallets store command',
    hidden: false,
    aliases: ['kt:wallets:store']
)]

class WalletsStoreCommand extends Command
{
    public function __construct(
        private readonly WalletsRequester $walletsRequester,
        private readonly WalletsStorer $walletsStorer,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $wallets = $this->walletsRequester->__invoke();

        $this->walletsStorer->__invoke(
            $wallets['time'],
            $wallets['value'],
        );

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->setHelp('Stores the current staking status of kuji tokens');
    }
}
