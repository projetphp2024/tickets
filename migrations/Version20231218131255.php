<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218131255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tickets ADD categorie_id INT DEFAULT NULL, ADD relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF4BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF43256915B FOREIGN KEY (relation_id) REFERENCES technologies (id)');
        $this->addSql('CREATE INDEX IDX_54469DF4BCF5E72D ON tickets (categorie_id)');
        $this->addSql('CREATE INDEX IDX_54469DF43256915B ON tickets (relation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF4BCF5E72D');
        $this->addSql('ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF43256915B');
        $this->addSql('DROP INDEX IDX_54469DF4BCF5E72D ON tickets');
        $this->addSql('DROP INDEX IDX_54469DF43256915B ON tickets');
        $this->addSql('ALTER TABLE tickets DROP categorie_id, DROP relation_id');
    }
}
