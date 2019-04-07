<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190407110556 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inventory_consumables MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE inventory_consumables DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE inventory_consumables ADD quantite INT NOT NULL, DROP id, CHANGE consumables_id consumables_id INT NOT NULL, CHANGE inventory_id inventory_id INT NOT NULL');
        $this->addSql('ALTER TABLE inventory_consumables ADD PRIMARY KEY (consumables_id, inventory_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inventory_consumables DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE inventory_consumables ADD id INT AUTO_INCREMENT NOT NULL, DROP quantite, CHANGE consumables_id consumables_id INT DEFAULT NULL, CHANGE inventory_id inventory_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory_consumables ADD PRIMARY KEY (id)');
    }
}
