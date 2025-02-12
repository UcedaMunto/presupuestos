<?php

namespace App\Entity;

use App\Repository\TipoServicioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoServicioRepository::class)]
class TipoServicio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, Servicio>
     */
    #[ORM\OneToMany(targetEntity: Servicio::class, mappedBy: 'tipoServicio')]
    private Collection $servicios;

    public function __construct()
    {
        $this->servicios = new ArrayCollection();
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

    /**
     * @return Collection<int, Servicio>
     */
    public function getServicios(): Collection
    {
        return $this->servicios;
    }

    public function addServicio(Servicio $servicio): static
    {
        if (!$this->servicios->contains($servicio)) {
            $this->servicios->add($servicio);
            $servicio->setTipoServicio($this);
        }

        return $this;
    }

    public function removeServicio(Servicio $servicio): static
    {
        if ($this->servicios->removeElement($servicio)) {
            // set the owning side to null (unless already changed)
            if ($servicio->getTipoServicio() === $this) {
                $servicio->setTipoServicio(null);
            }
        }

        return $this;
    }
}
