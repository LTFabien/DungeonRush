<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190330214102 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE stages_monsters (stages_id INT NOT NULL, monsters_id INT NOT NULL, INDEX IDX_E950FBD78E55E70A (stages_id), INDEX IDX_E950FBD745D33345 (monsters_id), PRIMARY KEY(stages_id, monsters_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stages_monsters ADD CONSTRAINT FK_E950FBD78E55E70A FOREIGN KEY (stages_id) REFERENCES stages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stages_monsters ADD CONSTRAINT FK_E950FBD745D33345 FOREIGN KEY (monsters_id) REFERENCES monsters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consumables ADD turn INT DEFAULT NULL');
        $this->addSql('ALTER TABLE monsters ADD hpmax INT NOT NULL, ADD hp INT NOT NULL, ADD mpmax INT NOT NULL, ADD mp INT NOT NULL, ADD strength INT NOT NULL, ADD intelligence INT NOT NULL, ADD spirit INT NOT NULL, ADD vitality INT NOT NULL, ADD speed INT NOT NULL');
        $this->addSql('ALTER TABLE move ADD cost INT DEFAULT NULL, ADD puissance INT NOT NULL');
        $this->addSql('ALTER TABLE stages ADD dungeons_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stages ADD CONSTRAINT FK_2FA26A6433C1EDAF FOREIGN KEY (dungeons_id) REFERENCES dungeons (id)');
        $this->addSql('CREATE INDEX IDX_2FA26A6433C1EDAF ON stages (dungeons_id)');
        $this->addSql('ALTER TABLE weapons ADD damage INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE stages_monsters');
        $this->addSql('ALTER TABLE consumables DROP turn');
        $this->addSql('ALTER TABLE monsters DROP hpmax, DROP hp, DROP mpmax, DROP mp, DROP strength, DROP intelligence, DROP spirit, DROP vitality, DROP speed');
        $this->addSql('ALTER TABLE move DROP cost, DROP puissance');
        $this->addSql('ALTER TABLE stages DROP FOREIGN KEY FK_2FA26A6433C1EDAF');
        $this->addSql('DROP INDEX IDX_2FA26A6433C1EDAF ON stages');
        $this->addSql('ALTER TABLE stages DROP dungeons_id');
        $this->addSql('ALTER TABLE weapons DROP damage');
    }
}
