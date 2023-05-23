<?php

declare(strict_types=1);

namespace DoctrineMigrations\Tenant;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523172347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `Order` (id INT AUTO_INCREMENT NOT NULL, orderName VARCHAR(255) NOT NULL, storeCategory_id INT NOT NULL, INDEX IDX_34E8BC9CD978B9A0 (storeCategory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE StoreCategory (id INT AUTO_INCREMENT NOT NULL, categoryName VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `Order` ADD CONSTRAINT FK_34E8BC9CD978B9A0 FOREIGN KEY (storeCategory_id) REFERENCES StoreCategory (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `Order` DROP FOREIGN KEY FK_34E8BC9CD978B9A0');
        $this->addSql('DROP TABLE `Order`');
        $this->addSql('DROP TABLE StoreCategory');
    }
}
