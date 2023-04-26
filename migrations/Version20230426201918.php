<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426201918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE umfrage ADD COLUMN url_hash VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, name FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT FK_8D93D6497E3C61F9 FOREIGN KEY (owner_id) REFERENCES logedin_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, name) SELECT id, name FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495E237E06 ON user (name)');
        $this->addSql('CREATE INDEX IDX_8D93D6497E3C61F9 ON user (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__umfrage AS SELECT id, logged_in_user_id, name, email, title, decription, expiration_date, private FROM umfrage');
        $this->addSql('DROP TABLE umfrage');
        $this->addSql('CREATE TABLE umfrage (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, logged_in_user_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, decription VARCHAR(255) DEFAULT NULL, expiration_date DATETIME NOT NULL, private BOOLEAN NOT NULL, CONSTRAINT FK_1E631F2C740FC49A FOREIGN KEY (logged_in_user_id) REFERENCES logedin_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO umfrage (id, logged_in_user_id, name, email, title, decription, expiration_date, private) SELECT id, logged_in_user_id, name, email, title, decription, expiration_date, private FROM __temp__umfrage');
        $this->addSql('DROP TABLE __temp__umfrage');
        $this->addSql('CREATE INDEX IDX_1E631F2C740FC49A ON umfrage (logged_in_user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, name FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, name) SELECT id, name FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495E237E06 ON user (name)');
    }
}
