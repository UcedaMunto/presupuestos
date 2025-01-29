<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Servicio extends ItemPresupuestario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private int $duracionMinutos;

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuracionMinutos(): int
    {
        return $this->duracionMinutos;
    }

    // Setters
    public function setDuracionMinutos(int $duracionMinutos): self
    {
        $this->duracionMinutos = $duracionMinutos;
        return $this;
    }
}
