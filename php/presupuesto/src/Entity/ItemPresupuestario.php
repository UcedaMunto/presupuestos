<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
abstract class ItemPresupuestario
{
    #[ORM\Column(type: 'string', length: 255)]
    protected string $nombre;

    #[ORM\Column(type: 'float')]
    protected float $precio;

    #[ORM\Column(type: 'text', nullable: true)]
    protected ?string $descripcion = null;

    // Getters
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    // Setters
    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;
        return $this;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;
        return $this;
    }
}
