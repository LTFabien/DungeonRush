<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190330211552 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE character_move DROP FOREIGN KEY FK_F8C223E01136BE75');
        $this->addSql('ALTER TABLE team_character DROP FOREIGN KEY FK_247FAED31136BE75');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, class_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, hpmax INT NOT NULL, hp INT NOT NULL, mpmax INT NOT NULL, mp INT NOT NULL, strength INT NOT NULL, intelligence INT NOT NULL, spirit INT NOT NULL, vitality INT NOT NULL, speed INT NOT NULL, INDEX IDX_98197A65EA000B10 (class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_move (player_id INT NOT NULL, move_id INT NOT NULL, INDEX IDX_4D24674B99E6F5DF (player_id), INDEX IDX_4D24674B6DC541A8 (move_id), PRIMARY KEY(player_id, move_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_player (team_id INT NOT NULL, player_id INT NOT NULL, INDEX IDX_EE023DBC296CD8AE (team_id), INDEX IDX_EE023DBC99E6F5DF (player_id), PRIMARY KEY(team_id, player_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE player_move ADD CONSTRAINT FK_4D24674B99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_move ADD CONSTRAINT FK_4D24674B6DC541A8 FOREIGN KEY (move_id) REFERENCES move (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_player ADD CONSTRAINT FK_EE023DBC296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_player ADD CONSTRAINT FK_EE023DBC99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_move');
        $this->addSql('DROP TABLE team_character');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player_move DROP FOREIGN KEY FK_4D24674B99E6F5DF');
        $this->addSql('ALTER TABLE team_player DROP FOREIGN KEY FK_EE023DBC99E6F5DF');
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, class_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, hpmax INT NOT NULL, hp INT NOT NULL, mpmax INT NOT NULL, mp INT NOT NULL, strength INT NOT NULL, intelligence INT NOT NULL, spirit INT NOT NULL, vitality INT NOT NULL, speed INT NOT NULL, INDEX IDX_937AB034EA000B10 (class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE character_move (character_id INT NOT NULL, move_id INT NOT NULL, INDEX IDX_F8C223E01136BE75 (character_id), INDEX IDX_F8C223E06DC541A8 (move_id), PRIMARY KEY(character_id, move_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE team_character (team_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_247FAED3296CD8AE (team_id), INDEX IDX_247FAED31136BE75 (character_id), PRIMARY KEY(team_id, character_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE character_move ADD CONSTRAINT FK_F8C223E01136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_move ADD CONSTRAINT FK_F8C223E06DC541A8 FOREIGN KEY (move_id) REFERENCES move (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_character ADD CONSTRAINT FK_247FAED31136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_character ADD CONSTRAINT FK_247FAED3296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_move');
        $this->addSql('DROP TABLE team_player');
    }
}
