<?php

namespace App\Entity;

use App\Repository\ReferenciaCompraRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ReferenciaCompraRepository::class)]
#[Vich\Uploadable]
class ReferenciaCompra
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $proveedor = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 100)]
    private ?string $referencia = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto1 = null;

    #[Vich\UploadableField(mapping: 'referencias', fileNameProperty: 'foto1')]
    private ?File $foto1a = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto2 = null;

    #[Vich\UploadableField(mapping: 'referencias', fileNameProperty: 'foto2')]
    private ?File $foto2a = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto3 = null;

    #[Vich\UploadableField(mapping: 'referencias', fileNameProperty: 'foto3')]
    private ?File $foto3a = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $actualizadoEn = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProveedor(): ?string
    {
        return $this->proveedor;
    }

    public function setProveedor(string $proveedor): static
    {
        $this->proveedor = $proveedor;
        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getReferencia(): ?string
    {
        return $this->referencia;
    }

    public function setReferencia(string $referencia): static
    {
        $this->referencia = $referencia;
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

    

    public function getActualizadoEn(): ?\DateTimeInterface
    {
        return $this->actualizadoEn;
    }

    public function setActualizadoEn(?\DateTimeInterface $fecha): void
    {
        $this->actualizadoEn = $fecha;
    }


}
