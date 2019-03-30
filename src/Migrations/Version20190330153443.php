<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190330153443 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, class_id INT NOT NULL, team_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, hpmax INT NOT NULL, hp INT NOT NULL, mpmax INT NOT NULL, mp INT NOT NULL, strength INT NOT NULL, intelligence INT NOT NULL, spirit INT NOT NULL, vitality INT NOT NULL, speed INT NOT NULL, INDEX IDX_937AB034EA000B10 (class_id), INDEX IDX_937AB034296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_move (character_id INT NOT NULL, move_id INT NOT NULL, INDEX IDX_F8C223E01136BE75 (character_id), INDEX IDX_F8C223E06DC541A8 (move_id), PRIMARY KEY(character_id, move_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, inventory_id INT NOT NULL, name VARCHAR(255) NOT NULL, money INT NOT NULL, UNIQUE INDEX UNIQ_C4E0A61F9EEA759 (inventory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE character_move ADD CONSTRAINT FK_F8C223E01136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_move ADD CONSTRAINT FK_F8C223E06DC541A8 FOREIGN KEY (move_id) REFERENCES move (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE character_move DROP FOREIGN KEY FK_F8C223E01136BE75');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034296CD8AE');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_move');
        $this->addSql('DROP TABLE team');
    }
}
