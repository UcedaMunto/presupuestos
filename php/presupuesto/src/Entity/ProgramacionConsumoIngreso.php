<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity]
class ProgramacionConsumoIngreso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Presupuesto::class, inversedBy: 'programaciones')]
    #[ORM\JoinColumn(nullable: false)]
    private Presupuesto $presupuesto;

    #[ORM\ManyToOne(targetEntity: Producto::class)]
    private ?Producto $producto = null;

    #[ORM\ManyToOne(targetEntity: Servicio::class)]
    private ?Servicio $servicio = null;

    #[ORM\Column(type: 'integer')]
    private int $cantidad;

    #[ORM\Column(type: 'string', length: 50)]
    private string $tipo; // 'consumo' o 'ingreso'

    #[ORM\Column(type: 'string', length: 50)]
    private string $frecuencia; // 'diaria', 'semanal', 'mensual'

    #[ORM\Column(type: 'datetime')]
    private DateTime $fechaInicio;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $fechaFin = null;

    public function __construct()
    {
        $this->fechaInicio = new DateTime();
    }

    // Getters y Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPresupuesto(): Presupuesto
    {
        return $this->presupuesto;
    }

    public function setPresupuesto(Presupuesto $presupuesto): self
    {
        $this->presupuesto = $presupuesto;
        return $this;
    }

    public function getProducto(): ?Producto
    {
        return $this->producto;
    }

    public function setProducto(?Producto $producto): self
    {
        $this->producto = $producto;
        return $this;
    }

    public function getServicio(): ?Servicio
    {
        return $this->servicio;
    }

    public function setServicio(?Servicio $servicio): self
    {
        $this->servicio = $servicio;
        return $this;
    }

    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;
        return $this;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function getFrecuencia(): string
    {
        return $this->frecuencia;
    }

    public function setFrecuencia(string $frecuencia): self
    {
        $this->frecuencia = $frecuencia;
        return $this;
    }

    public function getFechaInicio(): DateTime
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(DateTime $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;
        return $this;
    }

    public function getFechaFin(): ?DateTime
    {
        return $this->fechaFin;
    }

    public function setFechaFin(?DateTime $fechaFin): self
    {
        $this->fechaFin = $fechaFin;
        return $this;
    }
}
