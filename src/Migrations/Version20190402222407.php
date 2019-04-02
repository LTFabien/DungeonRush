<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190402222407 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE character_class_armor (character_class_id INT NOT NULL, armor_id INT NOT NULL, INDEX IDX_5D9A7566B201E281 (character_class_id), INDEX IDX_5D9A7566F5AA3663 (armor_id), PRIMARY KEY(character_class_id, armor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE armor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, defense INT NOT NULL, element VARCHAR(255) NOT NULL, lvl INT NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventory_armor (inventory_id INT NOT NULL, armor_id INT NOT NULL, INDEX IDX_63BB55FC9EEA759 (inventory_id), INDEX IDX_63BB55FCF5AA3663 (armor_id), PRIMARY KEY(inventory_id, armor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE character_class_armor ADD CONSTRAINT FK_5D9A7566B201E281 FOREIGN KEY (character_class_id) REFERENCES character_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_class_armor ADD CONSTRAINT FK_5D9A7566F5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventory_armor ADD CONSTRAINT FK_63BB55FC9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventory_armor ADD CONSTRAINT FK_63BB55FCF5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consumables ADD price INT NOT NULL');
        $this->addSql('ALTER TABLE dungeons ADD lvl INT NOT NULL');
        $this->addSql('ALTER TABLE monsters ADD exp INT NOT NULL, ADD gold INT NOT NULL');
        $this->addSql('ALTER TABLE move ADD element VARCHAR(255) NOT NULL, ADD price INT NOT NULL, ADD lvl INT NOT NULL');
        $this->addSql('ALTER TABLE weapons ADD element VARCHAR(255) NOT NULL, ADD price INT NOT NULL, ADD lvl INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE character_class_armor DROP FOREIGN KEY FK_5D9A7566F5AA3663');
        $this->addSql('ALTER TABLE inventory_armor DROP FOREIGN KEY FK_63BB55FCF5AA3663');
        $this->addSql('DROP TABLE character_class_armor');
        $this->addSql('DROP TABLE armor');
        $this->addSql('DROP TABLE inventory_armor');
        $this->addSql('ALTER TABLE consumables DROP price');
        $this->addSql('ALTER TABLE dungeons DROP lvl');
        $this->addSql('ALTER TABLE monsters DROP exp, DROP gold');
        $this->addSql('ALTER TABLE move DROP element, DROP price, DROP lvl');
        $this->addSql('ALTER TABLE weapons DROP element, DROP price, DROP lvl');
    }
}
