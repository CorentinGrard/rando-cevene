<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201005120757 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription ADD COLUMN date DATETIME NOT NULL');
        $this->addSql('DROP INDEX IDX_6D646B87C8C97C3C');
        $this->addSql('DROP INDEX IDX_6D646B875DAC5993');
        $this->addSql('CREATE TEMPORARY TABLE __temp__inscription_randonnee AS SELECT inscription_id, randonnee_id FROM inscription_randonnee');
        $this->addSql('DROP TABLE inscription_randonnee');
        $this->addSql('CREATE TABLE inscription_randonnee (inscription_id INTEGER NOT NULL, randonnee_id INTEGER NOT NULL, PRIMARY KEY(inscription_id, randonnee_id), CONSTRAINT FK_6D646B875DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6D646B87C8C97C3C FOREIGN KEY (randonnee_id) REFERENCES randonnee (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO inscription_randonnee (inscription_id, randonnee_id) SELECT inscription_id, randonnee_id FROM __temp__inscription_randonnee');
        $this->addSql('DROP TABLE __temp__inscription_randonnee');
        $this->addSql('CREATE INDEX IDX_6D646B87C8C97C3C ON inscription_randonnee (randonnee_id)');
        $this->addSql('CREATE INDEX IDX_6D646B875DAC5993 ON inscription_randonnee (inscription_id)');
        $this->addSql('DROP INDEX IDX_CB71A99FBCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__randonnee AS SELECT id, categorie_id, titre, description, duree, date FROM randonnee');
        $this->addSql('DROP TABLE randonnee');
        $this->addSql('CREATE TABLE randonnee (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categorie_id INTEGER NOT NULL, titre VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, duree INTEGER NOT NULL, date DATE NOT NULL, CONSTRAINT FK_CB71A99FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO randonnee (id, categorie_id, titre, description, duree, date) SELECT id, categorie_id, titre, description, duree, date FROM __temp__randonnee');
        $this->addSql('DROP TABLE __temp__randonnee');
        $this->addSql('CREATE INDEX IDX_CB71A99FBCF5E72D ON randonnee (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__inscription AS SELECT id, nom, email, message FROM inscription');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('CREATE TABLE inscription (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO inscription (id, nom, email, message) SELECT id, nom, email, message FROM __temp__inscription');
        $this->addSql('DROP TABLE __temp__inscription');
        $this->addSql('DROP INDEX IDX_6D646B875DAC5993');
        $this->addSql('DROP INDEX IDX_6D646B87C8C97C3C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__inscription_randonnee AS SELECT inscription_id, randonnee_id FROM inscription_randonnee');
        $this->addSql('DROP TABLE inscription_randonnee');
        $this->addSql('CREATE TABLE inscription_randonnee (inscription_id INTEGER NOT NULL, randonnee_id INTEGER NOT NULL, PRIMARY KEY(inscription_id, randonnee_id))');
        $this->addSql('INSERT INTO inscription_randonnee (inscription_id, randonnee_id) SELECT inscription_id, randonnee_id FROM __temp__inscription_randonnee');
        $this->addSql('DROP TABLE __temp__inscription_randonnee');
        $this->addSql('CREATE INDEX IDX_6D646B875DAC5993 ON inscription_randonnee (inscription_id)');
        $this->addSql('CREATE INDEX IDX_6D646B87C8C97C3C ON inscription_randonnee (randonnee_id)');
        $this->addSql('DROP INDEX IDX_CB71A99FBCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__randonnee AS SELECT id, categorie_id, titre, description, duree, date FROM randonnee');
        $this->addSql('DROP TABLE randonnee');
        $this->addSql('CREATE TABLE randonnee (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categorie_id INTEGER NOT NULL, titre VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, duree INTEGER NOT NULL, date DATE NOT NULL)');
        $this->addSql('INSERT INTO randonnee (id, categorie_id, titre, description, duree, date) SELECT id, categorie_id, titre, description, duree, date FROM __temp__randonnee');
        $this->addSql('DROP TABLE __temp__randonnee');
        $this->addSql('CREATE INDEX IDX_CB71A99FBCF5E72D ON randonnee (categorie_id)');
    }
}
