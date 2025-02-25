<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250225034214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE referencia_compra_id_seq CASCADE');
        $this->addSql('CREATE TABLE referencia (id SERIAL NOT NULL, codigo VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE referencia_compra');
        $this->addSql('ALTER TABLE producto ADD id_referencia_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB0615C9A540C7 FOREIGN KEY (id_referencia_id) REFERENCES referencia (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A7BB0615C9A540C7 ON producto (id_referencia_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE producto DROP CONSTRAINT FK_A7BB0615C9A540C7');
        $this->addSql('CREATE SEQUENCE referencia_compra_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE referencia_compra (id SERIAL NOT NULL, proveedor VARCHAR(100) NOT NULL, descripcion VARCHAR(100) DEFAULT NULL, referencia VARCHAR(100) NOT NULL, cantidad INT NOT NULL, foto1 VARCHAR(255) DEFAULT NULL, foto2 VARCHAR(255) DEFAULT NULL, foto3 VARCHAR(255) DEFAULT NULL, actualizado_en TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE referencia');
        $this->addSql('DROP INDEX IDX_A7BB0615C9A540C7');
        $this->addSql('ALTER TABLE producto DROP id_referencia_id');
    }
}
