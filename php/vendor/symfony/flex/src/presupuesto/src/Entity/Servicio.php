<?php

namespace App\Entity;

use App\Repository\ServicioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicioRepository::class)]
class Servicio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'servicios')]
    private ?CategoriaServicio $id_categoria = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCategoria(): ?CategoriaServicio
    {
        return $this->id_categoria;
    }

    public function setIdCategoria(?CategoriaServicio $id_categoria): static
    {
        $this->id_categoria = $id_categoria;

        return $this;
    }

}
