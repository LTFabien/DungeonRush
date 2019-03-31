<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190331222712 extends AbstractMigration
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
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034296CD8AE');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, class_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, hpmax INT NOT NULL, hp INT NOT NULL, mpmax INT NOT NULL, mp INT NOT NULL, strength INT NOT NULL, intelligence INT NOT NULL, spirit INT NOT NULL, vitality INT NOT NULL, speed INT NOT NULL, INDEX IDX_98197A65EA000B10 (class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_move (player_id INT NOT NULL, move_id INT NOT NULL, INDEX IDX_4D24674B99E6F5DF (player_id), INDEX IDX_4D24674B6DC541A8 (move_id), PRIMARY KEY(player_id, move_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stages_monsters (stages_id INT NOT NULL, monsters_id INT NOT NULL, INDEX IDX_E950FBD78E55E70A (stages_id), INDEX IDX_E950FBD745D33345 (monsters_id), PRIMARY KEY(stages_id, monsters_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, inventory_id INT NOT NULL, name VARCHAR(255) NOT NULL, money INT NOT NULL, UNIQUE INDEX UNIQ_C4E0A61F9EEA759 (inventory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_player (team_id INT NOT NULL, player_id INT NOT NULL, INDEX IDX_EE023DBC296CD8AE (team_id), INDEX IDX_EE023DBC99E6F5DF (player_id), PRIMARY KEY(team_id, player_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE player_move ADD CONSTRAINT FK_4D24674B99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_move ADD CONSTRAINT FK_4D24674B6DC541A8 FOREIGN KEY (move_id) REFERENCES move (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stages_monsters ADD CONSTRAINT FK_E950FBD78E55E70A FOREIGN KEY (stages_id) REFERENCES stages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stages_monsters ADD CONSTRAINT FK_E950FBD745D33345 FOREIGN KEY (monsters_id) REFERENCES monsters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('ALTER TABLE team_player ADD CONSTRAINT FK_EE023DBC296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_player ADD CONSTRAINT FK_EE023DBC99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_move');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('ALTER TABLE consumables ADD turn INT DEFAULT NULL');
        $this->addSql('ALTER TABLE monsters ADD hpmax INT NOT NULL, ADD hp INT NOT NULL, ADD mpmax INT NOT NULL, ADD mp INT NOT NULL, ADD strength INT NOT NULL, ADD intelligence INT NOT NULL, ADD spirit INT NOT NULL, ADD vitality INT NOT NULL, ADD speed INT NOT NULL');
        $this->addSql('ALTER TABLE move ADD cost INT DEFAULT NULL, ADD puissance INT NOT NULL');
        $this->addSql('ALTER TABLE stages ADD dungeons_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stages ADD CONSTRAINT FK_2FA26A6433C1EDAF FOREIGN KEY (dungeons_id) REFERENCES dungeons (id)');
        $this->addSql('CREATE INDEX IDX_2FA26A6433C1EDAF ON stages (dungeons_id)');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL');
        $this->addSql('ALTER TABLE weapons ADD damage INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player_move DROP FOREIGN KEY FK_4D24674B99E6F5DF');
        $this->addSql('ALTER TABLE team_player DROP FOREIGN KEY FK_EE023DBC99E6F5DF');
        $this->addSql('ALTER TABLE team_player DROP FOREIGN KEY FK_EE023DBC296CD8AE');
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, class_id INT DEFAULT NULL, team_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, hpmax INT NOT NULL, hp INT NOT NULL, mpmax INT NOT NULL, mp INT NOT NULL, strength INT NOT NULL, intelligence INT NOT NULL, spirit INT NOT NULL, vitality INT NOT NULL, speed INT NOT NULL, INDEX IDX_937AB034296CD8AE (team_id), INDEX IDX_937AB034EA000B10 (class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE character_move (character_id INT NOT NULL, move_id INT NOT NULL, INDEX IDX_F8C223E01136BE75 (character_id), INDEX IDX_F8C223E06DC541A8 (move_id), PRIMARY KEY(character_id, move_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, inventory_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, money INT NOT NULL, UNIQUE INDEX UNIQ_6DC044C59EEA759 (inventory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034296CD8AE FOREIGN KEY (team_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE character_move ADD CONSTRAINT FK_F8C223E01136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_move ADD CONSTRAINT FK_F8C223E06DC541A8 FOREIGN KEY (move_id) REFERENCES move (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C59EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_move');
        $this->addSql('DROP TABLE stages_monsters');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_player');
        $this->addSql('ALTER TABLE consumables DROP turn');
        $this->addSql('ALTER TABLE monsters DROP hpmax, DROP hp, DROP mpmax, DROP mp, DROP strength, DROP intelligence, DROP spirit, DROP vitality, DROP speed');
        $this->addSql('ALTER TABLE move DROP cost, DROP puissance');
        $this->addSql('ALTER TABLE stages DROP FOREIGN KEY FK_2FA26A6433C1EDAF');
        $this->addSql('DROP INDEX IDX_2FA26A6433C1EDAF ON stages');
        $this->addSql('ALTER TABLE stages DROP dungeons_id');
        $this->addSql('ALTER TABLE user DROP roles');
        $this->addSql('ALTER TABLE weapons DROP damage');
    }
}
