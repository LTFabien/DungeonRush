<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190407020658 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inventory_armor ADD inventory_id INT DEFAULT NULL, ADD armor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory_armor ADD CONSTRAINT FK_63BB55FC9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('ALTER TABLE inventory_armor ADD CONSTRAINT FK_63BB55FCF5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id)');
        $this->addSql('CREATE INDEX IDX_63BB55FC9EEA759 ON inventory_armor (inventory_id)');
        $this->addSql('CREATE INDEX IDX_63BB55FCF5AA3663 ON inventory_armor (armor_id)');
        $this->addSql('ALTER TABLE inventory_weapons ADD inventory_id INT DEFAULT NULL, ADD weapons_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inventory_weapons ADD CONSTRAINT FK_130A1D1D9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('ALTER TABLE inventory_weapons ADD CONSTRAINT FK_130A1D1D2EE82581 FOREIGN KEY (weapons_id) REFERENCES weapons (id)');
        $this->addSql('CREATE INDEX IDX_130A1D1D9EEA759 ON inventory_weapons (inventory_id)');
        $this->addSql('CREATE INDEX IDX_130A1D1D2EE82581 ON inventory_weapons (weapons_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inventory_armor DROP FOREIGN KEY FK_63BB55FC9EEA759');
        $this->addSql('ALTER TABLE inventory_armor DROP FOREIGN KEY FK_63BB55FCF5AA3663');
        $this->addSql('DROP INDEX IDX_63BB55FC9EEA759 ON inventory_armor');
        $this->addSql('DROP INDEX IDX_63BB55FCF5AA3663 ON inventory_armor');
        $this->addSql('ALTER TABLE inventory_armor DROP inventory_id, DROP armor_id');
        $this->addSql('ALTER TABLE inventory_weapons DROP FOREIGN KEY FK_130A1D1D9EEA759');
        $this->addSql('ALTER TABLE inventory_weapons DROP FOREIGN KEY FK_130A1D1D2EE82581');
        $this->addSql('DROP INDEX IDX_130A1D1D9EEA759 ON inventory_weapons');
        $this->addSql('DROP INDEX IDX_130A1D1D2EE82581 ON inventory_weapons');
        $this->addSql('ALTER TABLE inventory_weapons DROP inventory_id, DROP weapons_id');
    }
}
