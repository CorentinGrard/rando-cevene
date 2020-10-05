<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201005072843 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE inscription (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE inscription_randonnee (inscription_id INTEGER NOT NULL, randonnee_id INTEGER NOT NULL, PRIMARY KEY(inscription_id, randonnee_id))');
        $this->addSql('CREATE INDEX IDX_6D646B875DAC5993 ON inscription_randonnee (inscription_id)');
        $this->addSql('CREATE INDEX IDX_6D646B87C8C97C3C ON inscription_randonnee (randonnee_id)');
        $this->addSql('CREATE TABLE randonnee (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, duree INTEGER NOT NULL, date DATE NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE inscription_randonnee');
        $this->addSql('DROP TABLE randonnee');
    }
}
