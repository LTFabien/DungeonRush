<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190407125217 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inventory_armor MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE inventory_armor DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE inventory_armor DROP id, CHANGE inventory_id inventory_id INT NOT NULL, CHANGE armor_id armor_id INT NOT NULL');
        $this->addSql('ALTER TABLE inventory_armor ADD PRIMARY KEY (inventory_id, armor_id)');
        $this->addSql('ALTER TABLE inventory_weapons MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE inventory_weapons DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE inventory_weapons DROP id, CHANGE inventory_id inventory_id INT NOT NULL, CHANGE weapons_id weapons_id INT NOT NULL');
        $this->addSql('ALTER TABLE inventory_weapons ADD PRIMARY KEY (inventory_id, weapons_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inventory_armor DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE inventory_armor ADD id INT AUTO_INCREMENT NOT NULL, CHANGE inventory_id inventory_id INT DEFAULT NULL, CHANGE armor_id armor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory_armor ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE inventory_weapons DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE inventory_weapons ADD id INT AUTO_INCREMENT NOT NULL, CHANGE inventory_id inventory_id INT DEFAULT NULL, CHANGE weapons_id weapons_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory_weapons ADD PRIMARY KEY (id)');
    }
}
