<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316124915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE termin (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, umfrage_id_id INTEGER DEFAULT NULL, date DATETIME NOT NULL, CONSTRAINT FK_EFAFBA9C58896142 FOREIGN KEY (umfrage_id_id) REFERENCES umfrage (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_EFAFBA9C58896142 ON termin (umfrage_id_id)');
        $this->addSql('CREATE TABLE umfrage (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, decription VARCHAR(255) DEFAULT NULL, expiration_date DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE vote (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, termin_id_id INTEGER DEFAULT NULL, user_id_id INTEGER DEFAULT NULL, CONSTRAINT FK_5A10856472192A88 FOREIGN KEY (termin_id_id) REFERENCES termin (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5A1085649D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5A10856472192A88 ON vote (termin_id_id)');
        $this->addSql('CREATE INDEX IDX_5A1085649D86650F ON vote (user_id_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE termin');
        $this->addSql('DROP TABLE umfrage');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vote');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
