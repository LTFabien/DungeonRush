<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190406111529 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player ADD weapon_id INT DEFAULT NULL, ADD armor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A6595B82273 FOREIGN KEY (weapon_id) REFERENCES weapons (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65F5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id)');
        $this->addSql('CREATE INDEX IDX_98197A6595B82273 ON player (weapon_id)');
        $this->addSql('CREATE INDEX IDX_98197A65F5AA3663 ON player (armor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A6595B82273');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65F5AA3663');
        $this->addSql('DROP INDEX IDX_98197A6595B82273 ON player');
        $this->addSql('DROP INDEX IDX_98197A65F5AA3663 ON player');
        $this->addSql('ALTER TABLE player DROP weapon_id, DROP armor_id');
    }
}
