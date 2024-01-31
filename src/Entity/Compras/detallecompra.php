<?php

namespace App\Entity\Compras;

use App\Entity\Producto\producto;
use App\Repository\Compras\detallecompraRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: detallecompraRepository::class)]
class detallecompra
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'detallecompras')]
    #[ORM\JoinColumn(nullable: false)]
    private ?compras $compra = null;

    #[ORM\ManyToOne(inversedBy: 'detallecompras')]
    #[ORM\JoinColumn(nullable: false)]
    private ?producto $producto = null;

    #[ORM\Column]
    private ?int $dcm_cantidad = null;

    #[ORM\Column]
    private ?float $dcm_importe = null;

    #[ORM\Column]
    private ?int $dcm_estado = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompra(): ?compras
    {
        return $this->compra;
    }

    public function setCompra(?compras $compra): static
    {
        $this->compra = $compra;

        return $this;
    }

    public function getProducto(): ?producto
    {
        return $this->producto;
    }

    public function setProducto(?producto $producto): static
    {
        $this->producto = $producto;

        return $this;
    }

    public function getDcmCantidad(): ?int
    {
        return $this->dcm_cantidad;
    }

    public function setDcmCantidad(int $dcm_cantidad): static
    {
        $this->dcm_cantidad = $dcm_cantidad;

        return $this;
    }

    public function getDcmImporte(): ?float
    {
        return $this->dcm_importe;
    }

    public function setDcmImporte(float $dcm_importe): static
    {
        $this->dcm_importe = $dcm_importe;

        return $this;
    }

    public function getDcmEstado(): ?int
    {
        return $this->dcm_estado;
    }

    public function setDcmEstado(int $dcm_estado): static
    {
        $this->dcm_estado = $dcm_estado;

        return $this;
    }
}
