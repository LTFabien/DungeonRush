<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190406131205 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE monsters_move (monsters_id INT NOT NULL, move_id INT NOT NULL, INDEX IDX_B48DBE6B45D33345 (monsters_id), INDEX IDX_B48DBE6B6DC541A8 (move_id), PRIMARY KEY(monsters_id, move_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE monsters_move ADD CONSTRAINT FK_B48DBE6B45D33345 FOREIGN KEY (monsters_id) REFERENCES monsters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE monsters_move ADD CONSTRAINT FK_B48DBE6B6DC541A8 FOREIGN KEY (move_id) REFERENCES move (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE monsters_move');
    }
}
