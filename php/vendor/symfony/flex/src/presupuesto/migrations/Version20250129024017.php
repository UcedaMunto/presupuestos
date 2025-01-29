<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250129024017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE item_presupuesto_id_seq CASCADE');
        $this->addSql('CREATE TABLE consumo (id SERIAL NOT NULL, presupuesto_id INT NOT NULL, producto_id INT DEFAULT NULL, servicio_id INT DEFAULT NULL, cantidad INT NOT NULL, frecuencia VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DE7C314F90119F0F ON consumo (presupuesto_id)');
        $this->addSql('CREATE INDEX IDX_DE7C314F7645698E ON consumo (producto_id)');
        $this->addSql('CREATE INDEX IDX_DE7C314F71CAA3E7 ON consumo (servicio_id)');
        $this->addSql('ALTER TABLE consumo ADD CONSTRAINT FK_DE7C314F90119F0F FOREIGN KEY (presupuesto_id) REFERENCES presupuesto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE consumo ADD CONSTRAINT FK_DE7C314F7645698E FOREIGN KEY (producto_id) REFERENCES producto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE consumo ADD CONSTRAINT FK_DE7C314F71CAA3E7 FOREIGN KEY (servicio_id) REFERENCES servicio (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE item_presupuesto');
        $this->addSql('ALTER TABLE producto ADD nombre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE producto ADD precio DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE producto ADD descripcion TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE producto ADD unidad_medida VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE servicio DROP CONSTRAINT fk_cb86f22a10560508');
        $this->addSql('DROP INDEX idx_cb86f22a10560508');
        $this->addSql('ALTER TABLE servicio ADD nombre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE servicio ADD precio DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE servicio ADD descripcion TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE servicio ADD duracion_minutos INT NOT NULL');
        $this->addSql('ALTER TABLE servicio DROP id_categoria_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE item_presupuesto_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE item_presupuesto (id SERIAL NOT NULL, nombre VARCHAR(100) NOT NULL, precio DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE consumo DROP CONSTRAINT FK_DE7C314F90119F0F');
        $this->addSql('ALTER TABLE consumo DROP CONSTRAINT FK_DE7C314F7645698E');
        $this->addSql('ALTER TABLE consumo DROP CONSTRAINT FK_DE7C314F71CAA3E7');
        $this->addSql('DROP TABLE consumo');
        $this->addSql('ALTER TABLE servicio ADD id_categoria_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE servicio DROP nombre');
        $this->addSql('ALTER TABLE servicio DROP precio');
        $this->addSql('ALTER TABLE servicio DROP descripcion');
        $this->addSql('ALTER TABLE servicio DROP duracion_minutos');
        $this->addSql('ALTER TABLE servicio ADD CONSTRAINT fk_cb86f22a10560508 FOREIGN KEY (id_categoria_id) REFERENCES categoria_servicio (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_cb86f22a10560508 ON servicio (id_categoria_id)');
        $this->addSql('ALTER TABLE producto DROP nombre');
        $this->addSql('ALTER TABLE producto DROP precio');
        $this->addSql('ALTER TABLE producto DROP descripcion');
        $this->addSql('ALTER TABLE producto DROP unidad_medida');
    }
}
