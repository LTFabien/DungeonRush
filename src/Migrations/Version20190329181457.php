<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190329181457 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE character_group (character_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_9303A3A71136BE75 (character_id), INDEX IDX_9303A3A7FE54D947 (group_id), PRIMARY KEY(character_id, group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE character_group ADD CONSTRAINT FK_9303A3A71136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_group ADD CONSTRAINT FK_9303A3A7FE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034296CD8AE');
        $this->addSql('DROP INDEX IDX_937AB034296CD8AE ON `character`');
        $this->addSql('ALTER TABLE `character` DROP team_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE character_group');
        $this->addSql('ALTER TABLE `character` ADD team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034296CD8AE FOREIGN KEY (team_id) REFERENCES `group` (id)');
        $this->addSql('CREATE INDEX IDX_937AB034296CD8AE ON `character` (team_id)');
    }
}
