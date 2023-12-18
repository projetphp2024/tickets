<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218132418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tickets ADD technologie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF4261A27D2 FOREIGN KEY (technologie_id) REFERENCES technologies (id)');
        $this->addSql('CREATE INDEX IDX_54469DF4261A27D2 ON tickets (technologie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF4261A27D2');
        $this->addSql('DROP INDEX IDX_54469DF4261A27D2 ON tickets');
        $this->addSql('ALTER TABLE tickets DROP technologie_id');
    }
}
