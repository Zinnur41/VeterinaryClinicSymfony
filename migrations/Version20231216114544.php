<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231216114544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examination ADD pet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE examination ADD CONSTRAINT FK_CCDAABC5966F7FB6 FOREIGN KEY (pet_id) REFERENCES pet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CCDAABC5966F7FB6 ON examination (pet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE examination DROP CONSTRAINT FK_CCDAABC5966F7FB6');
        $this->addSql('DROP INDEX IDX_CCDAABC5966F7FB6');
        $this->addSql('ALTER TABLE examination DROP pet_id');
    }
}
