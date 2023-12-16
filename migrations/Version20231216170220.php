<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231216170220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examination ADD service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE examination ADD CONSTRAINT FK_CCDAABC5ED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CCDAABC5ED5CA9E6 ON examination (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE examination DROP CONSTRAINT FK_CCDAABC5ED5CA9E6');
        $this->addSql('DROP INDEX IDX_CCDAABC5ED5CA9E6');
        $this->addSql('ALTER TABLE examination DROP service_id');
    }
}
