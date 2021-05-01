<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210430200636 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ads ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE ads ADD CONSTRAINT FK_7EC9F62012469DE2 FOREIGN KEY (category_id) REFERENCES cats (id)');
        $this->addSql('CREATE INDEX IDX_7EC9F62012469DE2 ON ads (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ads DROP FOREIGN KEY FK_7EC9F62012469DE2');
        $this->addSql('DROP INDEX IDX_7EC9F62012469DE2 ON ads');
        $this->addSql('ALTER TABLE ads DROP category_id');
    }
}
