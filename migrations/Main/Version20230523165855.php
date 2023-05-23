<?php

declare(strict_types=1);

namespace DoctrineMigrations\Main;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523165855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tenant_user (id INT AUTO_INCREMENT NOT NULL, tenant_db_config_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C7FC8C9AE7927C74 (email), INDEX IDX_C7FC8C9A36224B68 (tenant_db_config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tenant_user ADD CONSTRAINT FK_C7FC8C9A36224B68 FOREIGN KEY (tenant_db_config_id) REFERENCES tenant_db_config (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tenant_user DROP FOREIGN KEY FK_C7FC8C9A36224B68');
        $this->addSql('DROP TABLE tenant_user');
    }
}
