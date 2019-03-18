<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190318233551 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE inventory_weapons (inventory_id INT NOT NULL, weapons_id INT NOT NULL, INDEX IDX_130A1D1D9EEA759 (inventory_id), INDEX IDX_130A1D1D2EE82581 (weapons_id), PRIMARY KEY(inventory_id, weapons_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventory_consumables (inventory_id INT NOT NULL, consumables_id INT NOT NULL, INDEX IDX_EFDDE1FF9EEA759 (inventory_id), INDEX IDX_EFDDE1FFDD6DA630 (consumables_id), PRIMARY KEY(inventory_id, consumables_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inventory_weapons ADD CONSTRAINT FK_130A1D1D9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventory_weapons ADD CONSTRAINT FK_130A1D1D2EE82581 FOREIGN KEY (weapons_id) REFERENCES weapons (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventory_consumables ADD CONSTRAINT FK_EFDDE1FF9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventory_consumables ADD CONSTRAINT FK_EFDDE1FFDD6DA630 FOREIGN KEY (consumables_id) REFERENCES consumables (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `character` ADD hpmax INT NOT NULL, ADD hp INT NOT NULL, ADD mpmax INT NOT NULL, ADD mp INT NOT NULL, ADD strength INT NOT NULL, ADD intelligence INT NOT NULL, ADD spirit INT NOT NULL, ADD vitality INT NOT NULL, ADD speed INT NOT NULL');
        $this->addSql('ALTER TABLE `group` ADD inventaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C5CE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventory (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6DC044C5CE430A85 ON `group` (inventaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE inventory_weapons');
        $this->addSql('DROP TABLE inventory_consumables');
        $this->addSql('ALTER TABLE `character` DROP hpmax, DROP hp, DROP mpmax, DROP mp, DROP strength, DROP intelligence, DROP spirit, DROP vitality, DROP speed');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C5CE430A85');
        $this->addSql('DROP INDEX UNIQ_6DC044C5CE430A85 ON `group`');
        $this->addSql('ALTER TABLE `group` DROP inventaire_id');
    }
}
