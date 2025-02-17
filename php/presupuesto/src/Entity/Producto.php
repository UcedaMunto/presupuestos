<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Producto extends ItemPresupuestario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $unidadMedida;

    #[ORM\ManyToOne]
    private ?TipoProducto $tipoProducto = null;

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnidadMedida(): string
    {
        return $this->unidadMedida;
    }

    // Setters
    public function setUnidadMedida(string $unidadMedida): self
    {
        $this->unidadMedida = $unidadMedida;
        return $this;
    }

    public function getTipoProducto(): ?TipoProducto
    {
        return $this->tipoProducto;
    }
    
    public function setTipoProducto(?TipoProducto $tipoProducto): static
    {
        $this->tipoProducto = $tipoProducto;
        return $this;
    }
}
