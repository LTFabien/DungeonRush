<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190330175708 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE character_character_class');
        $this->addSql('ALTER TABLE `character` ADD class_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('CREATE INDEX IDX_937AB034EA000B10 ON `character` (class_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE character_character_class (character_id INT NOT NULL, character_class_id INT NOT NULL, INDEX IDX_58A5C7C21136BE75 (character_id), INDEX IDX_58A5C7C2B201E281 (character_class_id), PRIMARY KEY(character_id, character_class_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE character_character_class ADD CONSTRAINT FK_58A5C7C21136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_character_class ADD CONSTRAINT FK_58A5C7C2B201E281 FOREIGN KEY (character_class_id) REFERENCES character_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034EA000B10');
        $this->addSql('DROP INDEX IDX_937AB034EA000B10 ON `character`');
        $this->addSql('ALTER TABLE `character` DROP class_id');
    }
}
