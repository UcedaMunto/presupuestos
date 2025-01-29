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

    #[ORM\Column(type: 'string', length: 255)]
    private string $unidadMedida; // Ejemplo: kg, litros, unidades

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
}
