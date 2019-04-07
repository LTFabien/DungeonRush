<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190407033820 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE inventory_consumables (id INT AUTO_INCREMENT NOT NULL, consumables_id INT DEFAULT NULL, inventory_id INT DEFAULT NULL, INDEX IDX_EFDDE1FFDD6DA630 (consumables_id), INDEX IDX_EFDDE1FF9EEA759 (inventory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inventory_consumables ADD CONSTRAINT FK_EFDDE1FFDD6DA630 FOREIGN KEY (consumables_id) REFERENCES consumables (id)');
        $this->addSql('ALTER TABLE inventory_consumables ADD CONSTRAINT FK_EFDDE1FF9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE inventory_consumables');
    }
}
