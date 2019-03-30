<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190330151227 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE character_group DROP FOREIGN KEY FK_9303A3A71136BE75');
        $this->addSql('ALTER TABLE character_move DROP FOREIGN KEY FK_F8C223E01136BE75');
        $this->addSql('ALTER TABLE character_group DROP FOREIGN KEY FK_9303A3A7FE54D947');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_group');
        $this->addSql('DROP TABLE character_move');
        $this->addSql('DROP TABLE `group`');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, class_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, hpmax INT NOT NULL, hp INT NOT NULL, mpmax INT NOT NULL, mp INT NOT NULL, strength INT NOT NULL, intelligence INT NOT NULL, spirit INT NOT NULL, vitality INT NOT NULL, speed INT NOT NULL, INDEX IDX_937AB034EA000B10 (class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE character_group (character_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_9303A3A71136BE75 (character_id), INDEX IDX_9303A3A7FE54D947 (group_id), PRIMARY KEY(character_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE character_move (character_id INT NOT NULL, move_id INT NOT NULL, INDEX IDX_F8C223E01136BE75 (character_id), INDEX IDX_F8C223E06DC541A8 (move_id), PRIMARY KEY(character_id, move_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, inventory_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, money INT NOT NULL, UNIQUE INDEX UNIQ_6DC044C59EEA759 (inventory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE character_group ADD CONSTRAINT FK_9303A3A71136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_group ADD CONSTRAINT FK_9303A3A7FE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_move ADD CONSTRAINT FK_F8C223E01136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_move ADD CONSTRAINT FK_F8C223E06DC541A8 FOREIGN KEY (move_id) REFERENCES move (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C59EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
    }
}
