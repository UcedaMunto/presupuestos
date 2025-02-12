<?php

namespace App\Entity;

use App\Repository\TipoProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoProductoRepository::class)]
class TipoProducto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, DetallePresupuesto>
     */
    #[ORM\OneToMany(targetEntity: DetallePresupuesto::class, mappedBy: 'id_tipo_item')]
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

    public function setNombre(?string $nombre): static
    {
        $this->nombre = $nombre;

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
            $detallePresupuesto->setIdTipoItem($this);
        }

        return $this;
    }

    public function removeDetallePresupuesto(DetallePresupuesto $detallePresupuesto): static
    {
        if ($this->detallePresupuestos->removeElement($detallePresupuesto)) {
            // set the owning side to null (unless already changed)
            if ($detallePresupuesto->getIdTipoItem() === $this) {
                $detallePresupuesto->setIdTipoItem(null);
            }
        }

        return $this;
    }
}
