<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204020520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE programacion_consumo_ingreso (id SERIAL NOT NULL, presupuesto_id INT NOT NULL, producto_id INT DEFAULT NULL, servicio_id INT DEFAULT NULL, cantidad INT NOT NULL, tipo VARCHAR(50) NOT NULL, frecuencia VARCHAR(50) NOT NULL, fecha_inicio TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_fin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7BB92BAE90119F0F ON programacion_consumo_ingreso (presupuesto_id)');
        $this->addSql('CREATE INDEX IDX_7BB92BAE7645698E ON programacion_consumo_ingreso (producto_id)');
        $this->addSql('CREATE INDEX IDX_7BB92BAE71CAA3E7 ON programacion_consumo_ingreso (servicio_id)');
        $this->addSql('ALTER TABLE programacion_consumo_ingreso ADD CONSTRAINT FK_7BB92BAE90119F0F FOREIGN KEY (presupuesto_id) REFERENCES presupuesto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE programacion_consumo_ingreso ADD CONSTRAINT FK_7BB92BAE7645698E FOREIGN KEY (producto_id) REFERENCES producto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE programacion_consumo_ingreso ADD CONSTRAINT FK_7BB92BAE71CAA3E7 FOREIGN KEY (servicio_id) REFERENCES servicio (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE programacion_consumo_ingreso DROP CONSTRAINT FK_7BB92BAE90119F0F');
        $this->addSql('ALTER TABLE programacion_consumo_ingreso DROP CONSTRAINT FK_7BB92BAE7645698E');
        $this->addSql('ALTER TABLE programacion_consumo_ingreso DROP CONSTRAINT FK_7BB92BAE71CAA3E7');
        $this->addSql('DROP TABLE programacion_consumo_ingreso');
    }
}
