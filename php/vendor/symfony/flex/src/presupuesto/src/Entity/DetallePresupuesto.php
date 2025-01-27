<?php

namespace App\Entity;

use App\Repository\DetallePresupuestoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetallePresupuestoRepository::class)]
class DetallePresupuesto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'detallePresupuestos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Presupuesto $id_presupuesto = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    #[ORM\Column]
    private ?float $precio_initario = null;

    #[ORM\Column(nullable: true)]
    private ?float $sub_total = null;

    #[ORM\Column]
    private ?int $item_presupuesto_id = null;

    #[ORM\ManyToOne(inversedBy: 'detallePresupuestos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TipoProducto $id_tipo_item = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPresupuesto(): ?Presupuesto
    {
        return $this->id_presupuesto;
    }

    public function setIdPresupuesto(?Presupuesto $id_presupuesto): static
    {
        $this->id_presupuesto = $id_presupuesto;

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

    public function getPrecioInitario(): ?float
    {
        return $this->precio_initario;
    }

    public function setPrecioInitario(float $precio_initario): static
    {
        $this->precio_initario = $precio_initario;

        return $this;
    }

    public function getSubTotal(): ?float
    {
        return $this->sub_total;
    }

    public function setSubTotal(?float $sub_total): static
    {
        $this->sub_total = $sub_total;

        return $this;
    }

    public function getItemPresupuestoId(): ?int
    {
        return $this->item_presupuesto_id;
    }

    public function setItemPresupuestoId(int $item_presupuesto_id): static
    {
        $this->item_presupuesto_id = $item_presupuesto_id;

        return $this;
    }

    public function getIdTipoItem(): ?TipoProducto
    {
        return $this->id_tipo_item;
    }

    public function setIdTipoItem(?TipoProducto $id_tipo_item): static
    {
        $this->id_tipo_item = $id_tipo_item;

        return $this;
    }
}
