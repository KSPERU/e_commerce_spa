<?php

namespace App\Entity\Factura;

use App\Entity\Producto\producto;
use App\Repository\Factura\detallefacturaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: detallefacturaRepository::class)]
class detallefactura
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'detallefacturas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?factura $factura = null;

    #[ORM\ManyToOne(inversedBy: 'detallefacturas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?producto $producto = null;

    #[ORM\Column]
    private ?int $df_cantidad = null;

    #[ORM\Column]
    private ?float $df_importe = null;

    #[ORM\Column(nullable: true)]
    private ?float $df_descuento = null;

    #[ORM\Column(nullable: true)]
    private ?float $df_importefinal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFactura(): ?factura
    {
        return $this->factura;
    }

    public function setFactura(?factura $factura): static
    {
        $this->factura = $factura;

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

    public function getDfCantidad(): ?int
    {
        return $this->df_cantidad;
    }

    public function setDfCantidad(int $df_cantidad): static
    {
        $this->df_cantidad = $df_cantidad;

        return $this;
    }

    public function getDfImporte(): ?float
    {
        return $this->df_importe;
    }

    public function setDfImporte(float $df_importe): static
    {
        $this->df_importe = $df_importe;

        return $this;
    }

    public function getDfDescuento(): ?float
    {
        return $this->df_descuento;
    }

    public function setDfDescuento(?float $df_descuento): static
    {
        $this->df_descuento = $df_descuento;

        return $this;
    }

    public function getDfImportefinal(): ?float
    {
        return $this->df_importefinal;
    }

    public function setDfImportefinal(?float $df_importefinal): static
    {
        $this->df_importefinal = $df_importefinal;

        return $this;
    }
}
