<?php

namespace App\Entity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[Vich\Uploadable]
class Producto extends ItemPresupuestario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $unidadMedida;

    #[ORM\ManyToOne]
    private ?TipoProducto $tipoProducto = null;

    #[Vich\UploadableField(mapping: 'productos', fileNameProperty: 'foto1')]
    private ?File $foto1a = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto2 = null;

    #[Vich\UploadableField(mapping: 'productos', fileNameProperty: 'foto2')]
    private ?File $foto2a = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto3 = null;

    #[Vich\UploadableField(mapping: 'productos', fileNameProperty: 'foto3')]
    private ?File $foto3a = null;
    

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

    public function getTipoProducto(): ?TipoProducto
    {
        return $this->tipoProducto;
    }
    
    public function setTipoProducto(?TipoProducto $tipoProducto): static
    {
        $this->tipoProducto = $tipoProducto;
        return $this;
    }

    public function getFoto1(): ?string
    {
        return $this->foto1;
    }

    public function setFoto1(?string $foto1): static
    {
        $this->foto1 = $foto1;
        return $this;
    }

    public function getFoto2(): ?string
    {
        return $this->foto2;
    }

    public function setFoto2(?string $foto2): static
    {
        $this->foto2 = $foto2;
        return $this;
    }

    public function getFoto3(): ?string
    {
        return $this->foto3;
    }

    public function setFoto3(?string $foto3): static
    {
        $this->foto3 = $foto3;
        return $this;
    }

    public function setFoto1a(?File $foto1a = null): void
    {
        $this->foto1a = $foto1a;
        if ($foto1a) {
            $this->actualizadoEn = new \DateTimeImmutable();
        }
    }

    public function getFoto1a(): ?File
    {
        return $this->foto1a;
    }

    public function setFoto2a(?File $foto2a = null): void
    {
        $this->foto2a = $foto2a;
        if ($foto2a) {
            $this->actualizadoEn = new \DateTimeImmutable();
        }
    }

    public function getFoto2a(): ?File
    {
        return $this->foto2a;
    }

    public function setFoto3a(?File $foto3a = null): void
    {
        $this->foto3a = $foto3a;
        if ($foto3a) {
            $this->actualizadoEn = new \DateTimeImmutable();
        }
    }

    public function getFoto3a(): ?File
    {
        return $this->foto3a;
    }
}
