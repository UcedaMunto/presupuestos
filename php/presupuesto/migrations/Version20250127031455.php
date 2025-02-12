<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127031455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria_servicio (id SERIAL NOT NULL, nombre VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE detalle_presupuesto (id SERIAL NOT NULL, id_presupuesto_id INT NOT NULL, id_tipo_item_id INT NOT NULL, cantidad INT NOT NULL, precio_initario DOUBLE PRECISION NOT NULL, sub_total DOUBLE PRECISION DEFAULT NULL, item_presupuesto_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_577C85A0AD772209 ON detalle_presupuesto (id_presupuesto_id)');
        $this->addSql('CREATE INDEX IDX_577C85A02257068C ON detalle_presupuesto (id_tipo_item_id)');
        $this->addSql('CREATE TABLE estado_presupuesto (id SERIAL NOT NULL, nombre VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE item_presupuesto (id SERIAL NOT NULL, nombre VARCHAR(100) NOT NULL, precio DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE presupuesto (id SERIAL NOT NULL, id_estado_id INT NOT NULL, nombre VARCHAR(100) NOT NULL, monto_total NUMERIC(15, 2) NOT NULL, fecha_inicio DATE NOT NULL, fecha_fin DATE DEFAULT NULL, estado BOOLEAN DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_aprobacion TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, total DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1B6368D31F6FF82C ON presupuesto (id_estado_id)');
        $this->addSql('COMMENT ON COLUMN presupuesto.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE producto (id SERIAL NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE servicio (id SERIAL NOT NULL, id_categoria_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CB86F22A10560508 ON servicio (id_categoria_id)');
        $this->addSql('CREATE TABLE tipo_producto (id SERIAL NOT NULL, nombre VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE detalle_presupuesto ADD CONSTRAINT FK_577C85A0AD772209 FOREIGN KEY (id_presupuesto_id) REFERENCES presupuesto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detalle_presupuesto ADD CONSTRAINT FK_577C85A02257068C FOREIGN KEY (id_tipo_item_id) REFERENCES tipo_producto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE presupuesto ADD CONSTRAINT FK_1B6368D31F6FF82C FOREIGN KEY (id_estado_id) REFERENCES estado_presupuesto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE servicio ADD CONSTRAINT FK_CB86F22A10560508 FOREIGN KEY (id_categoria_id) REFERENCES categoria_servicio (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE detalle_presupuesto DROP CONSTRAINT FK_577C85A0AD772209');
        $this->addSql('ALTER TABLE detalle_presupuesto DROP CONSTRAINT FK_577C85A02257068C');
        $this->addSql('ALTER TABLE presupuesto DROP CONSTRAINT FK_1B6368D31F6FF82C');
        $this->addSql('ALTER TABLE servicio DROP CONSTRAINT FK_CB86F22A10560508');
        $this->addSql('DROP TABLE categoria_servicio');
        $this->addSql('DROP TABLE detalle_presupuesto');
        $this->addSql('DROP TABLE estado_presupuesto');
        $this->addSql('DROP TABLE item_presupuesto');
        $this->addSql('DROP TABLE presupuesto');
        $this->addSql('DROP TABLE producto');
        $this->addSql('DROP TABLE servicio');
        $this->addSql('DROP TABLE tipo_producto');
    }
}
