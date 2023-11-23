<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220824104833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE community_pool (id INT AUTO_INCREMENT NOT NULL, denom LONGTEXT NOT NULL, token LONGTEXT NOT NULL, amount DOUBLE PRECISION NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staked_tokens (id INT AUTO_INCREMENT NOT NULL, not_bonded_tokens DOUBLE PRECISION NOT NULL, bonded_tokens DOUBLE PRECISION NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE token (id INT AUTO_INCREMENT NOT NULL, base_currency LONGTEXT NOT NULL, target_currency LONGTEXT NOT NULL, ticker_id LONGTEXT NOT NULL, ask DOUBLE PRECISION NOT NULL, bid DOUBLE PRECISION NOT NULL, high DOUBLE PRECISION NOT NULL, low DOUBLE PRECISION NOT NULL, base_volume DOUBLE PRECISION NOT NULL, target_volume DOUBLE PRECISION NOT NULL, last_price DOUBLE PRECISION NOT NULL, pool_id LONGTEXT NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transactions (id INT AUTO_INCREMENT NOT NULL, num INT NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wallets (id INT AUTO_INCREMENT NOT NULL, num INT NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE community_pool');
        $this->addSql('DROP TABLE staked_tokens');
        $this->addSql('DROP TABLE token');
        $this->addSql('DROP TABLE transactions');
        $this->addSql('DROP TABLE wallets');
    }
}
