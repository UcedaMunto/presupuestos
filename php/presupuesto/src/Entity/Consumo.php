<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Consumo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Presupuesto::class, inversedBy: 'consumos')]
    #[ORM\JoinColumn(nullable: false)]
    private Presupuesto $presupuesto;

    #[ORM\ManyToOne(targetEntity: Producto::class)]
    private ?Producto $producto = null;

    #[ORM\ManyToOne(targetEntity: Servicio::class)]
    private ?Servicio $servicio = null;

    #[ORM\Column(type: 'integer')]
    private int $cantidad;

    #[ORM\Column(nullable: true)]
    private ?int $frecuencia = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?float $total = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fecha = null;

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPresupuesto(): Presupuesto
    {
        return $this->presupuesto;
    }

    public function getProducto(): ?Producto
    {
        return $this->producto;
    }

    public function getServicio(): ?Servicio
    {
        return $this->servicio;
    }

    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    // Setters
    public function setPresupuesto(Presupuesto $presupuesto): self
    {
        $this->presupuesto = $presupuesto;
        return $this;
    }

    public function setProducto(?Producto $producto): self
    {
        $this->producto = $producto;
        return $this;
    }

    public function setServicio(?Servicio $servicio): self
    {
        $this->servicio = $servicio;
        return $this;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;
        return $this;
    }

    public function getFrecuencia(): ?int
    {
        return $this->frecuencia;
    }

    public function setFrecuencia(?int $frecuencia): static
    {
        $this->frecuencia = $frecuencia;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }


}
