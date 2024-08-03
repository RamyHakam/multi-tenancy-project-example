<?php

declare(strict_types=1);

namespace DoctrineMigrations\Tenant;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240803102807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE Order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE StoreCategory_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "Order" (id INT NOT NULL, orderName VARCHAR(255) NOT NULL, storeCategory_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_34E8BC9CD978B9A0 ON "Order" (storeCategory_id)');
        $this->addSql('CREATE TABLE StoreCategory (id INT NOT NULL, categoryName VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "Order" ADD CONSTRAINT FK_34E8BC9CD978B9A0 FOREIGN KEY (storeCategory_id) REFERENCES StoreCategory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE Order_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE StoreCategory_id_seq CASCADE');
        $this->addSql('ALTER TABLE "Order" DROP CONSTRAINT FK_34E8BC9CD978B9A0');
        $this->addSql('DROP TABLE "Order"');
        $this->addSql('DROP TABLE StoreCategory');
    }
}
