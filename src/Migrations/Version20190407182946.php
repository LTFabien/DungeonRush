<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190407182946 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE armor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, defense INT NOT NULL, element VARCHAR(255) NOT NULL, lvl INT NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, hpmax INT NOT NULL, hp INT NOT NULL, mpmax INT NOT NULL, mp INT NOT NULL, strength INT NOT NULL, intelligence INT NOT NULL, speed INT NOT NULL, vitality INT NOT NULL, spirit INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_class_weapons (character_class_id INT NOT NULL, weapons_id INT NOT NULL, INDEX IDX_A3CA6164B201E281 (character_class_id), INDEX IDX_A3CA61642EE82581 (weapons_id), PRIMARY KEY(character_class_id, weapons_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_class_move (character_class_id INT NOT NULL, move_id INT NOT NULL, INDEX IDX_EACFB9B1B201E281 (character_class_id), INDEX IDX_EACFB9B16DC541A8 (move_id), PRIMARY KEY(character_class_id, move_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_class_armor (character_class_id INT NOT NULL, armor_id INT NOT NULL, INDEX IDX_5D9A7566B201E281 (character_class_id), INDEX IDX_5D9A7566F5AA3663 (armor_id), PRIMARY KEY(character_class_id, armor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consumables (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, stat VARCHAR(255) NOT NULL, number INT NOT NULL, turn INT DEFAULT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dungeons (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, lvl INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventory (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventory_armor (inventory_id INT NOT NULL, armor_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_63BB55FC9EEA759 (inventory_id), INDEX IDX_63BB55FCF5AA3663 (armor_id), PRIMARY KEY(inventory_id, armor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventory_consumables (consumables_id INT NOT NULL, inventory_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_EFDDE1FFDD6DA630 (consumables_id), INDEX IDX_EFDDE1FF9EEA759 (inventory_id), PRIMARY KEY(consumables_id, inventory_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventory_weapons (inventory_id INT NOT NULL, weapons_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_130A1D1D9EEA759 (inventory_id), INDEX IDX_130A1D1D2EE82581 (weapons_id), PRIMARY KEY(inventory_id, weapons_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monsters (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, hpmax INT NOT NULL, hp INT NOT NULL, mpmax INT NOT NULL, mp INT NOT NULL, strength INT NOT NULL, intelligence INT NOT NULL, spirit INT NOT NULL, vitality INT NOT NULL, speed INT NOT NULL, exp INT NOT NULL, gold INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monsters_move (monsters_id INT NOT NULL, move_id INT NOT NULL, INDEX IDX_B48DBE6B45D33345 (monsters_id), INDEX IDX_B48DBE6B6DC541A8 (move_id), PRIMARY KEY(monsters_id, move_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE move (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, cost INT DEFAULT NULL, puissance INT NOT NULL, element VARCHAR(255) NOT NULL, price INT NOT NULL, lvl INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, class_id INT DEFAULT NULL, weapon_id INT DEFAULT NULL, armor_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, hpmax INT NOT NULL, hp INT NOT NULL, mpmax INT NOT NULL, mp INT NOT NULL, strength INT NOT NULL, intelligence INT NOT NULL, spirit INT NOT NULL, vitality INT NOT NULL, speed INT NOT NULL, INDEX IDX_98197A65EA000B10 (class_id), INDEX IDX_98197A6595B82273 (weapon_id), INDEX IDX_98197A65F5AA3663 (armor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_move (player_id INT NOT NULL, move_id INT NOT NULL, INDEX IDX_4D24674B99E6F5DF (player_id), INDEX IDX_4D24674B6DC541A8 (move_id), PRIMARY KEY(player_id, move_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stages (id INT AUTO_INCREMENT NOT NULL, dungeons_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2FA26A6433C1EDAF (dungeons_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stages_monsters (stages_id INT NOT NULL, monsters_id INT NOT NULL, INDEX IDX_E950FBD78E55E70A (stages_id), INDEX IDX_E950FBD745D33345 (monsters_id), PRIMARY KEY(stages_id, monsters_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, inventory_id INT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, money INT NOT NULL, lvl INT NOT NULL, exp INT NOT NULL, UNIQUE INDEX UNIQ_C4E0A61F9EEA759 (inventory_id), UNIQUE INDEX UNIQ_C4E0A61FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_player (team_id INT NOT NULL, player_id INT NOT NULL, INDEX IDX_EE023DBC296CD8AE (team_id), INDEX IDX_EE023DBC99E6F5DF (player_id), PRIMARY KEY(team_id, player_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weapons (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, damage INT NOT NULL, element VARCHAR(255) NOT NULL, price INT NOT NULL, lvl INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE character_class_weapons ADD CONSTRAINT FK_A3CA6164B201E281 FOREIGN KEY (character_class_id) REFERENCES character_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_class_weapons ADD CONSTRAINT FK_A3CA61642EE82581 FOREIGN KEY (weapons_id) REFERENCES weapons (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_class_move ADD CONSTRAINT FK_EACFB9B1B201E281 FOREIGN KEY (character_class_id) REFERENCES character_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_class_move ADD CONSTRAINT FK_EACFB9B16DC541A8 FOREIGN KEY (move_id) REFERENCES move (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_class_armor ADD CONSTRAINT FK_5D9A7566B201E281 FOREIGN KEY (character_class_id) REFERENCES character_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_class_armor ADD CONSTRAINT FK_5D9A7566F5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventory_armor ADD CONSTRAINT FK_63BB55FC9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('ALTER TABLE inventory_armor ADD CONSTRAINT FK_63BB55FCF5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id)');
        $this->addSql('ALTER TABLE inventory_consumables ADD CONSTRAINT FK_EFDDE1FFDD6DA630 FOREIGN KEY (consumables_id) REFERENCES consumables (id)');
        $this->addSql('ALTER TABLE inventory_consumables ADD CONSTRAINT FK_EFDDE1FF9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('ALTER TABLE inventory_weapons ADD CONSTRAINT FK_130A1D1D9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('ALTER TABLE inventory_weapons ADD CONSTRAINT FK_130A1D1D2EE82581 FOREIGN KEY (weapons_id) REFERENCES weapons (id)');
        $this->addSql('ALTER TABLE monsters_move ADD CONSTRAINT FK_B48DBE6B45D33345 FOREIGN KEY (monsters_id) REFERENCES monsters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE monsters_move ADD CONSTRAINT FK_B48DBE6B6DC541A8 FOREIGN KEY (move_id) REFERENCES move (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A6595B82273 FOREIGN KEY (weapon_id) REFERENCES weapons (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65F5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id)');
        $this->addSql('ALTER TABLE player_move ADD CONSTRAINT FK_4D24674B99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_move ADD CONSTRAINT FK_4D24674B6DC541A8 FOREIGN KEY (move_id) REFERENCES move (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stages ADD CONSTRAINT FK_2FA26A6433C1EDAF FOREIGN KEY (dungeons_id) REFERENCES dungeons (id)');
        $this->addSql('ALTER TABLE stages_monsters ADD CONSTRAINT FK_E950FBD78E55E70A FOREIGN KEY (stages_id) REFERENCES stages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stages_monsters ADD CONSTRAINT FK_E950FBD745D33345 FOREIGN KEY (monsters_id) REFERENCES monsters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE team_player ADD CONSTRAINT FK_EE023DBC296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_player ADD CONSTRAINT FK_EE023DBC99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE character_class_armor DROP FOREIGN KEY FK_5D9A7566F5AA3663');
        $this->addSql('ALTER TABLE inventory_armor DROP FOREIGN KEY FK_63BB55FCF5AA3663');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65F5AA3663');
        $this->addSql('ALTER TABLE character_class_weapons DROP FOREIGN KEY FK_A3CA6164B201E281');
        $this->addSql('ALTER TABLE character_class_move DROP FOREIGN KEY FK_EACFB9B1B201E281');
        $this->addSql('ALTER TABLE character_class_armor DROP FOREIGN KEY FK_5D9A7566B201E281');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65EA000B10');
        $this->addSql('ALTER TABLE inventory_consumables DROP FOREIGN KEY FK_EFDDE1FFDD6DA630');
        $this->addSql('ALTER TABLE stages DROP FOREIGN KEY FK_2FA26A6433C1EDAF');
        $this->addSql('ALTER TABLE inventory_armor DROP FOREIGN KEY FK_63BB55FC9EEA759');
        $this->addSql('ALTER TABLE inventory_consumables DROP FOREIGN KEY FK_EFDDE1FF9EEA759');
        $this->addSql('ALTER TABLE inventory_weapons DROP FOREIGN KEY FK_130A1D1D9EEA759');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F9EEA759');
        $this->addSql('ALTER TABLE monsters_move DROP FOREIGN KEY FK_B48DBE6B45D33345');
        $this->addSql('ALTER TABLE stages_monsters DROP FOREIGN KEY FK_E950FBD745D33345');
        $this->addSql('ALTER TABLE character_class_move DROP FOREIGN KEY FK_EACFB9B16DC541A8');
        $this->addSql('ALTER TABLE monsters_move DROP FOREIGN KEY FK_B48DBE6B6DC541A8');
        $this->addSql('ALTER TABLE player_move DROP FOREIGN KEY FK_4D24674B6DC541A8');
        $this->addSql('ALTER TABLE player_move DROP FOREIGN KEY FK_4D24674B99E6F5DF');
        $this->addSql('ALTER TABLE team_player DROP FOREIGN KEY FK_EE023DBC99E6F5DF');
        $this->addSql('ALTER TABLE stages_monsters DROP FOREIGN KEY FK_E950FBD78E55E70A');
        $this->addSql('ALTER TABLE team_player DROP FOREIGN KEY FK_EE023DBC296CD8AE');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FA76ED395');
        $this->addSql('ALTER TABLE character_class_weapons DROP FOREIGN KEY FK_A3CA61642EE82581');
        $this->addSql('ALTER TABLE inventory_weapons DROP FOREIGN KEY FK_130A1D1D2EE82581');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A6595B82273');
        $this->addSql('DROP TABLE armor');
        $this->addSql('DROP TABLE character_class');
        $this->addSql('DROP TABLE character_class_weapons');
        $this->addSql('DROP TABLE character_class_move');
        $this->addSql('DROP TABLE character_class_armor');
        $this->addSql('DROP TABLE consumables');
        $this->addSql('DROP TABLE dungeons');
        $this->addSql('DROP TABLE inventory');
        $this->addSql('DROP TABLE inventory_armor');
        $this->addSql('DROP TABLE inventory_consumables');
        $this->addSql('DROP TABLE inventory_weapons');
        $this->addSql('DROP TABLE monsters');
        $this->addSql('DROP TABLE monsters_move');
        $this->addSql('DROP TABLE move');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_move');
        $this->addSql('DROP TABLE stages');
        $this->addSql('DROP TABLE stages_monsters');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_player');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE weapons');
    }
}
