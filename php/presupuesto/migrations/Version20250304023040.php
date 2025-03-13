<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250304023040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plan_compras (id SERIAL NOT NULL, fecha_viaje DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE producto_listado (id SERIAL NOT NULL, id_presupuesto_id INT NOT NULL, id_referencia_id INT NOT NULL, nombre VARCHAR(100) DEFAULT NULL, cantidad INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A0EE32ECAD772209 ON producto_listado (id_presupuesto_id)');
        $this->addSql('CREATE INDEX IDX_A0EE32ECC9A540C7 ON producto_listado (id_referencia_id)');
        $this->addSql('ALTER TABLE producto_listado ADD CONSTRAINT FK_A0EE32ECAD772209 FOREIGN KEY (id_presupuesto_id) REFERENCES presupuesto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE producto_listado ADD CONSTRAINT FK_A0EE32ECC9A540C7 FOREIGN KEY (id_referencia_id) REFERENCES referencia (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE producto_listado DROP CONSTRAINT FK_A0EE32ECAD772209');
        $this->addSql('ALTER TABLE producto_listado DROP CONSTRAINT FK_A0EE32ECC9A540C7');
        $this->addSql('DROP TABLE plan_compras');
        $this->addSql('DROP TABLE producto_listado');
    }
}
