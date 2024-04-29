<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220729141326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bow_tvl (id INT AUTO_INCREMENT NOT NULL, pair VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, balance VARCHAR(50) NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bw_vaults (id INT AUTO_INCREMENT NOT NULL, pair VARCHAR(255) NOT NULL, vault_address VARCHAR(255) NOT NULL, performance VARCHAR(255) NOT NULL, profit_in_usdc VARCHAR(255) NOT NULL, liquidity VARCHAR(255) NOT NULL, base_denom VARCHAR(255) NOT NULL, quote_denom VARCHAR(255) NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE community_pool (id INT AUTO_INCREMENT NOT NULL, denom LONGTEXT NOT NULL, token LONGTEXT NOT NULL, amount DOUBLE PRECISION NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ghost_borrowed (id INT AUTO_INCREMENT NOT NULL, num DOUBLE PRECISION NOT NULL, collateral VARCHAR(255) NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ghost_deposit (id INT AUTO_INCREMENT NOT NULL, num DOUBLE PRECISION NOT NULL, collateral VARCHAR(255) NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liquidations (id INT AUTO_INCREMENT NOT NULL, liquidation_id INT NOT NULL, timestamp INT NOT NULL, burn_amount VARCHAR(255) NOT NULL, contract_address VARCHAR(255) NOT NULL, refund_amount VARCHAR(255) NOT NULL, liquidate_amount VARCHAR(255) NOT NULL, fee_amount VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locked_manta (id INT AUTO_INCREMENT NOT NULL, locked DOUBLE PRECISION NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staked_manta (id INT AUTO_INCREMENT NOT NULL, bonded DOUBLE PRECISION NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staked_tokens (id INT AUTO_INCREMENT NOT NULL, not_bonded_tokens DOUBLE PRECISION NOT NULL, bonded_tokens DOUBLE PRECISION NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE token (id INT AUTO_INCREMENT NOT NULL, base_currency LONGTEXT NOT NULL, target_currency LONGTEXT NOT NULL, ticker_id LONGTEXT NOT NULL, ask DOUBLE PRECISION NOT NULL, bid DOUBLE PRECISION NOT NULL, high DOUBLE PRECISION NOT NULL, low DOUBLE PRECISION NOT NULL, base_volume DOUBLE PRECISION NOT NULL, target_volume DOUBLE PRECISION NOT NULL, last_price DOUBLE PRECISION NOT NULL, pool_id LONGTEXT NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transactions (id INT AUTO_INCREMENT NOT NULL, num INT NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unmigrated (id INT AUTO_INCREMENT NOT NULL, num INT NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usk_minted (id INT AUTO_INCREMENT NOT NULL, num DOUBLE PRECISION NOT NULL, collateral VARCHAR(255) DEFAULT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wallets (id INT AUTO_INCREMENT NOT NULL, num INT NOT NULL, tracked DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bow_tvl');
        $this->addSql('DROP TABLE bw_vaults');
        $this->addSql('DROP TABLE community_pool');
        $this->addSql('DROP TABLE ghost_borrowed');
        $this->addSql('DROP TABLE ghost_deposit');
        $this->addSql('DROP TABLE liquidations');
        $this->addSql('DROP TABLE locked_manta');
        $this->addSql('DROP TABLE staked_manta');
        $this->addSql('DROP TABLE staked_tokens');
        $this->addSql('DROP TABLE token');
        $this->addSql('DROP TABLE transactions');
        $this->addSql('DROP TABLE unmigrated');
        $this->addSql('DROP TABLE usk_minted');
        $this->addSql('DROP TABLE wallets');
    }
}
