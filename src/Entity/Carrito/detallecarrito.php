<?php

namespace App\Entity\Carrito;

use App\Entity\Producto\producto;
use App\Repository\Carrito\detallecarritoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: detallecarritoRepository::class)]
class detallecarrito
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'detallescarrito')]
    #[ORM\JoinColumn(nullable: false)]
    private ?carrito $carrito = null;

    #[ORM\ManyToOne(inversedBy: 'detallecarritos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?producto $producto = null;

    #[ORM\Column]
    private ?int $dc_cantidad = null;

    #[ORM\Column]
    private ?float $dc_importe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarrito(): ?carrito
    {
        return $this->carrito;
    }

    public function setCarrito(?carrito $carrito): static
    {
        $this->carrito = $carrito;

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

    public function getDcCantidad(): ?int
    {
        return $this->dc_cantidad;
    }

    public function setDcCantidad(int $dc_cantidad): static
    {
        $this->dc_cantidad = $dc_cantidad;

        return $this;
    }

    public function getDcImporte(): ?float
    {
        return $this->dc_importe;
    }

    public function setDcImporte(float $dc_importe): static
    {
        $this->dc_importe = $dc_importe;

        return $this;
    }
}
