<?php

namespace App\Entity;

use App\Repository\PresupuestoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: PresupuestoRepository::class)]
class Presupuesto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $montoTotal = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaInicio = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fechaFin = null;

    #[ORM\Column(nullable: true)]
    private ?bool $estado = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fecha_aprobacion = null;

    #[ORM\Column(nullable: true)]
    private ?float $total = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?EstadoPresupuesto $id_estado = null;

    /**
     * @var Collection<int, DetallePresupuesto>
     */
    #[ORM\OneToMany(targetEntity: DetallePresupuesto::class, mappedBy: 'id_presupuesto')]
    private Collection $detallePresupuestos;

    public function __construct()
    {
        $this->detallePresupuestos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getMontoTotal(): ?string
    {
        return $this->montoTotal;
    }

    public function setMontoTotal(string $montoTotal): static
    {
        $this->montoTotal = $montoTotal;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): static
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(?\DateTimeInterface $fechaFin): static
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    public function isEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(?bool $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getFechaAprobacion(): ?\DateTimeInterface
    {
        return $this->fecha_aprobacion;
    }

    public function setFechaAprobacion(?\DateTimeInterface $fecha_aprobacion): static
    {
        $this->fecha_aprobacion = $fecha_aprobacion;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getIdEstado(): ?EstadoPresupuesto
    {
        return $this->id_estado;
    }

    public function setIdEstado(?EstadoPresupuesto $id_estado): static
    {
        $this->id_estado = $id_estado;

        return $this;
    }

    /**
     * @return Collection<int, DetallePresupuesto>
     */
    public function getDetallePresupuestos(): Collection
    {
        return $this->detallePresupuestos;
    }

    public function addDetallePresupuesto(DetallePresupuesto $detallePresupuesto): static
    {
        if (!$this->detallePresupuestos->contains($detallePresupuesto)) {
            $this->detallePresupuestos->add($detallePresupuesto);
            $detallePresupuesto->setIdPresupuesto($this);
        }

        return $this;
    }

    public function removeDetallePresupuesto(DetallePresupuesto $detallePresupuesto): static
    {
        if ($this->detallePresupuestos->removeElement($detallePresupuesto)) {
            // set the owning side to null (unless already changed)
            if ($detallePresupuesto->getIdPresupuesto() === $this) {
                $detallePresupuesto->setIdPresupuesto(null);
            }
        }

        return $this;
    }
}
