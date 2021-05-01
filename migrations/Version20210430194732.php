<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210430194732 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cats (id INT AUTO_INCREMENT NOT NULL, cats_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_C39DBA9284200A6 (cats_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cats ADD CONSTRAINT FK_C39DBA9284200A6 FOREIGN KEY (cats_id) REFERENCES cats (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cats DROP FOREIGN KEY FK_C39DBA9284200A6');
        $this->addSql('DROP TABLE cats');
    }
}
