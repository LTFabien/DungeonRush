<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190407175837 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE consumables CHANGE stat_buffed stat VARCHAR(255) NOT NULL, CHANGE number_buff number INT NOT NULL');
        $this->addSql('ALTER TABLE inventory_armor DROP FOREIGN KEY FK_63BB55FC9EEA759');
        $this->addSql('ALTER TABLE inventory_armor DROP FOREIGN KEY FK_63BB55FCF5AA3663');
        $this->addSql('ALTER TABLE inventory_armor ADD quantite INT NOT NULL');
        $this->addSql('ALTER TABLE inventory_armor ADD CONSTRAINT FK_63BB55FC9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('ALTER TABLE inventory_armor ADD CONSTRAINT FK_63BB55FCF5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id)');
        $this->addSql('ALTER TABLE inventory_consumables DROP FOREIGN KEY FK_EFDDE1FF9EEA759');
        $this->addSql('ALTER TABLE inventory_consumables DROP FOREIGN KEY FK_EFDDE1FFDD6DA630');
        $this->addSql('ALTER TABLE inventory_consumables DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE inventory_consumables ADD quantite INT NOT NULL');
        $this->addSql('ALTER TABLE inventory_consumables ADD CONSTRAINT FK_EFDDE1FF9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('ALTER TABLE inventory_consumables ADD CONSTRAINT FK_EFDDE1FFDD6DA630 FOREIGN KEY (consumables_id) REFERENCES consumables (id)');
        $this->addSql('ALTER TABLE inventory_consumables ADD PRIMARY KEY (consumables_id, inventory_id)');
        $this->addSql('ALTER TABLE inventory_weapons DROP FOREIGN KEY FK_130A1D1D2EE82581');
        $this->addSql('ALTER TABLE inventory_weapons DROP FOREIGN KEY FK_130A1D1D9EEA759');
        $this->addSql('ALTER TABLE inventory_weapons ADD quantite INT NOT NULL');
        $this->addSql('ALTER TABLE inventory_weapons ADD CONSTRAINT FK_130A1D1D2EE82581 FOREIGN KEY (weapons_id) REFERENCES weapons (id)');
        $this->addSql('ALTER TABLE inventory_weapons ADD CONSTRAINT FK_130A1D1D9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE consumables CHANGE stat stat_buffed VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE number number_buff INT NOT NULL');
        $this->addSql('ALTER TABLE inventory_armor DROP FOREIGN KEY FK_63BB55FC9EEA759');
        $this->addSql('ALTER TABLE inventory_armor DROP FOREIGN KEY FK_63BB55FCF5AA3663');
        $this->addSql('ALTER TABLE inventory_armor DROP quantite');
        $this->addSql('ALTER TABLE inventory_armor ADD CONSTRAINT FK_63BB55FC9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventory_armor ADD CONSTRAINT FK_63BB55FCF5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventory_consumables DROP FOREIGN KEY FK_EFDDE1FFDD6DA630');
        $this->addSql('ALTER TABLE inventory_consumables DROP FOREIGN KEY FK_EFDDE1FF9EEA759');
        $this->addSql('ALTER TABLE inventory_consumables DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE inventory_consumables DROP quantite');
        $this->addSql('ALTER TABLE inventory_consumables ADD CONSTRAINT FK_EFDDE1FFDD6DA630 FOREIGN KEY (consumables_id) REFERENCES consumables (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventory_consumables ADD CONSTRAINT FK_EFDDE1FF9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventory_consumables ADD PRIMARY KEY (inventory_id, consumables_id)');
        $this->addSql('ALTER TABLE inventory_weapons DROP FOREIGN KEY FK_130A1D1D9EEA759');
        $this->addSql('ALTER TABLE inventory_weapons DROP FOREIGN KEY FK_130A1D1D2EE82581');
        $this->addSql('ALTER TABLE inventory_weapons DROP quantite');
        $this->addSql('ALTER TABLE inventory_weapons ADD CONSTRAINT FK_130A1D1D9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventory_weapons ADD CONSTRAINT FK_130A1D1D2EE82581 FOREIGN KEY (weapons_id) REFERENCES weapons (id) ON DELETE CASCADE');
    }
}
