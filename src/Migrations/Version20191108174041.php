<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191108174041 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE registro (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, apellidos VARCHAR(100) NOT NULL, sexo VARCHAR(10) NOT NULL, correo VARCHAR(80) NOT NULL, universidad VARCHAR(120) NOT NULL, semestre VARCHAR(40) NOT NULL, promedio VARCHAR(6) NOT NULL, profesor VARCHAR(120) NOT NULL, correo_profesor VARCHAR(80) NOT NULL, beca VARCHAR(40) NOT NULL, restricciones LONGTEXT DEFAULT NULL, token VARCHAR(10) NOT NULL, slug VARCHAR(128) NOT NULL, created DATE NOT NULL, UNIQUE INDEX UNIQ_397CA85B989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE registro');
    }
}
