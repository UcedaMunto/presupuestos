<?php

namespace App\Entity;

use App\Repository\ProductoListadoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoListadoRepository::class)]
class ProductoListado
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $nombre = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Presupuesto $idPresupuesto = null;

    #[ORM\ManyToOne(inversedBy: 'ListaPresupuesto')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Referencia $idReferencia = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getIdPresupuesto(): ?Presupuesto
    {
        return $this->idPresupuesto;
    }

    public function setIdPresupuesto(?Presupuesto $idPresupuesto): static
    {
        $this->idPresupuesto = $idPresupuesto;

        return $this;
    }

    public function getIdReferencia(): ?Referencia
    {
        return $this->idReferencia;
    }

    public function setIdReferencia(?Referencia $idReferencia): static
    {
        $this->idReferencia = $idReferencia;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }
}
