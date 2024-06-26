<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416165547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bow_tvl CHANGE balance balance VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE liquidations CHANGE liquidation_id liquidation_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bow_tvl CHANGE balance balance VARCHAR(50) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE liquidations CHANGE liquidation_id liquidation_id VARCHAR(255) DEFAULT \'\' NOT NULL');
    }
}
