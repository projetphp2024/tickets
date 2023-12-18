<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218132828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE solved_by (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tickets ADD solved_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF4D5A00226 FOREIGN KEY (solved_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_54469DF4D5A00226 ON tickets (solved_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE solved_by');
        $this->addSql('ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF4D5A00226');
        $this->addSql('DROP INDEX IDX_54469DF4D5A00226 ON tickets');
        $this->addSql('ALTER TABLE tickets DROP solved_by_id');
    }
}
