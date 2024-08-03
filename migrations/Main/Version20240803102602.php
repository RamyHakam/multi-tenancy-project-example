<?php

declare(strict_types=1);

namespace DoctrineMigrations\Main;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240803102602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE tenant_db_config_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tenant_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tenant_db_config (id INT NOT NULL, db_name VARCHAR(255) NOT NULL, driver_type VARCHAR(255) DEFAULT \'mysql\' NOT NULL, db_user_name VARCHAR(255) DEFAULT NULL, db_password VARCHAR(255) DEFAULT NULL, db_host VARCHAR(255) DEFAULT NULL, db_port VARCHAR(5) DEFAULT NULL, database_status VARCHAR(255) DEFAULT \'DATABASE_NOT_CREATED\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tenant_user (id INT NOT NULL, tenant_db_config_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7FC8C9AE7927C74 ON tenant_user (email)');
        $this->addSql('CREATE INDEX IDX_C7FC8C9A36224B68 ON tenant_user (tenant_db_config_id)');
        $this->addSql('ALTER TABLE tenant_user ADD CONSTRAINT FK_C7FC8C9A36224B68 FOREIGN KEY (tenant_db_config_id) REFERENCES tenant_db_config (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE tenant_db_config_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tenant_user_id_seq CASCADE');
        $this->addSql('ALTER TABLE tenant_user DROP CONSTRAINT FK_C7FC8C9A36224B68');
        $this->addSql('DROP TABLE tenant_db_config');
        $this->addSql('DROP TABLE tenant_user');
    }
}
