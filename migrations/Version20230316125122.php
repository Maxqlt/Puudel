<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316125122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vote ADD COLUMN answer VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__vote AS SELECT id, termin_id_id, user_id_id FROM vote');
        $this->addSql('DROP TABLE vote');
        $this->addSql('CREATE TABLE vote (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, termin_id_id INTEGER DEFAULT NULL, user_id_id INTEGER DEFAULT NULL, CONSTRAINT FK_5A10856472192A88 FOREIGN KEY (termin_id_id) REFERENCES termin (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5A1085649D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO vote (id, termin_id_id, user_id_id) SELECT id, termin_id_id, user_id_id FROM __temp__vote');
        $this->addSql('DROP TABLE __temp__vote');
        $this->addSql('CREATE INDEX IDX_5A10856472192A88 ON vote (termin_id_id)');
        $this->addSql('CREATE INDEX IDX_5A1085649D86650F ON vote (user_id_id)');
    }
}
