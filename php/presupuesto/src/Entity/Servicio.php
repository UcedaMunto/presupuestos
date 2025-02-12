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

    #[ORM\ManyToOne(inversedBy: 'servicios')]
    private ?TipoServicio $tipoServicio = null;

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

    public function getTipoServicio(): ?TipoServicio
    {
        return $this->tipoServicio;
    }

    public function setTipoServicio(?TipoServicio $tipoServicio): static
    {
        $this->tipoServicio = $tipoServicio;

        return $this;
    }
}
