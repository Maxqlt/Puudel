<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230427090607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE logedin_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DE8BC6E8E7927C74 ON logedin_user (email)');
        $this->addSql('CREATE TABLE termin (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, umfrage_id_id INTEGER DEFAULT NULL, date DATETIME NOT NULL, CONSTRAINT FK_EFAFBA9C58896142 FOREIGN KEY (umfrage_id_id) REFERENCES umfrage (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_EFAFBA9C58896142 ON termin (umfrage_id_id)');
        $this->addSql('CREATE TABLE umfrage (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, logged_in_user_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, decription VARCHAR(255) DEFAULT NULL, expiration_date DATETIME NOT NULL, private BOOLEAN NOT NULL, url_hash VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_1E631F2C740FC49A FOREIGN KEY (logged_in_user_id) REFERENCES logedin_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_1E631F2C740FC49A ON umfrage (logged_in_user_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT FK_8D93D6497E3C61F9 FOREIGN KEY (owner_id) REFERENCES logedin_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495E237E06 ON user (name)');
        $this->addSql('CREATE INDEX IDX_8D93D6497E3C61F9 ON user (owner_id)');
        $this->addSql('CREATE TABLE vote (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, termin_id_id INTEGER DEFAULT NULL, user_id_id INTEGER DEFAULT NULL, answer VARCHAR(255) NOT NULL, CONSTRAINT FK_5A10856472192A88 FOREIGN KEY (termin_id_id) REFERENCES termin (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5A1085649D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
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
        $this->addSql('DROP TABLE logedin_user');
        $this->addSql('DROP TABLE termin');
        $this->addSql('DROP TABLE umfrage');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vote');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
