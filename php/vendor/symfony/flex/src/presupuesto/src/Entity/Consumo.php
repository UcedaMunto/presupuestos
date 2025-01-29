<?php

namespace App\Entity;

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

    #[ORM\Column(type: 'string', length: 50)]
    private string $frecuencia; // 'diaria', 'semanal', 'mensual'

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

    public function getFrecuencia(): string
    {
        return $this->frecuencia;
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

    public function setFrecuencia(string $frecuencia): self
    {
        $this->frecuencia = $frecuencia;
        return $this;
    }
}
