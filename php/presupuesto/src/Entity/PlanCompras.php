<?php

namespace App\Entity;

use App\Repository\PlanComprasRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanComprasRepository::class)]
class PlanCompras
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fecha_viaje = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaViaje(): ?\DateTimeInterface
    {
        return $this->fecha_viaje;
    }

    public function setFechaViaje(?\DateTimeInterface $fecha_viaje): static
    {
        $this->fecha_viaje = $fecha_viaje;

        return $this;
    }
}
