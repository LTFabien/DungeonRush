<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190318222820 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, class_id INT DEFAULT NULL, team_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_937AB034EA000B10 (class_id), INDEX IDX_937AB034296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_move (character_id INT NOT NULL, move_id INT NOT NULL, INDEX IDX_F8C223E01136BE75 (character_id), INDEX IDX_F8C223E06DC541A8 (move_id), PRIMARY KEY(character_id, move_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_class_weapons (character_class_id INT NOT NULL, weapons_id INT NOT NULL, INDEX IDX_A3CA6164B201E281 (character_class_id), INDEX IDX_A3CA61642EE82581 (weapons_id), PRIMARY KEY(character_class_id, weapons_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_class_move (character_class_id INT NOT NULL, move_id INT NOT NULL, INDEX IDX_EACFB9B1B201E281 (character_class_id), INDEX IDX_EACFB9B16DC541A8 (move_id), PRIMARY KEY(character_class_id, move_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, inventory_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, money INT NOT NULL, UNIQUE INDEX UNIQ_6DC044C59EEA759 (inventory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventory (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE move (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weapons (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034296CD8AE FOREIGN KEY (team_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE character_move ADD CONSTRAINT FK_F8C223E01136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_move ADD CONSTRAINT FK_F8C223E06DC541A8 FOREIGN KEY (move_id) REFERENCES move (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_class_weapons ADD CONSTRAINT FK_A3CA6164B201E281 FOREIGN KEY (character_class_id) REFERENCES character_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_class_weapons ADD CONSTRAINT FK_A3CA61642EE82581 FOREIGN KEY (weapons_id) REFERENCES weapons (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_class_move ADD CONSTRAINT FK_EACFB9B1B201E281 FOREIGN KEY (character_class_id) REFERENCES character_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_class_move ADD CONSTRAINT FK_EACFB9B16DC541A8 FOREIGN KEY (move_id) REFERENCES move (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C59EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('ALTER TABLE user CHANGE confirm_password email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE character_move DROP FOREIGN KEY FK_F8C223E01136BE75');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034296CD8AE');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C59EEA759');
        $this->addSql('ALTER TABLE character_move DROP FOREIGN KEY FK_F8C223E06DC541A8');
        $this->addSql('ALTER TABLE character_class_move DROP FOREIGN KEY FK_EACFB9B16DC541A8');
        $this->addSql('ALTER TABLE character_class_weapons DROP FOREIGN KEY FK_A3CA61642EE82581');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_move');
        $this->addSql('DROP TABLE character_class_weapons');
        $this->addSql('DROP TABLE character_class_move');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE inventory');
        $this->addSql('DROP TABLE move');
        $this->addSql('DROP TABLE weapons');
        $this->addSql('ALTER TABLE user CHANGE email confirm_password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
