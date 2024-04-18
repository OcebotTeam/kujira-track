<?php

namespace Ocebot\KujiraTrack\App\Command\Mint;

use Ocebot\KujiraTrack\Mint\Application\MintCurrentValueBulkStorer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'kt:mint:store',
    description: 'Store current minted values',
    hidden: false,
    aliases: ['kt:mint:store']
)]

class MintStoreCommand extends Command
{
    public function __construct(
        private readonly MintCurrentValueBulkStorer $bulkMintStorer
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->bulkMintStorer->__invoke();
        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->setHelp('Stores current minted values');
    }
}
