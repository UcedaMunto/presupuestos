<?php

namespace App\Entity;

use App\Repository\ReferenciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReferenciaRepository::class)]
class Referencia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $codigo = null;

    /**
     * @var Collection<int, ProductoListado>
     */
    #[ORM\OneToMany(targetEntity: ProductoListado::class, mappedBy: 'idReferencia')]
    private Collection $ListaPresupuesto;

    public function __construct()
    {
        $this->ListaPresupuesto = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): static
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * @return Collection<int, ProductoListado>
     */
    public function getListaPresupuesto(): Collection
    {
        return $this->ListaPresupuesto;
    }

    public function addListaPresupuesto(ProductoListado $listaPresupuesto): static
    {
        if (!$this->ListaPresupuesto->contains($listaPresupuesto)) {
            $this->ListaPresupuesto->add($listaPresupuesto);
            $listaPresupuesto->setIdReferencia($this);
        }

        return $this;
    }

    public function removeListaPresupuesto(ProductoListado $listaPresupuesto): static
    {
        if ($this->ListaPresupuesto->removeElement($listaPresupuesto)) {
            // set the owning side to null (unless already changed)
            if ($listaPresupuesto->getIdReferencia() === $this) {
                $listaPresupuesto->setIdReferencia(null);
            }
        }

        return $this;
    }
}
