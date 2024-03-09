<?php

namespace App\Entity\Producto;

use App\Entity\Carrito\detallecarrito;
use App\Entity\Compras\detallecompra;
use App\Entity\Descuento\descuento;
use App\Entity\Factura\detallefactura;
use App\Entity\Usuario\usuario;
use App\Entity\Valoracion\valoracion;
use App\Repository\Producto\productoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: productoRepository::class)]
class producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $pr_nombre = null;

    #[ORM\Column(length: 50)]
    private ?string $pr_categoria = null;

    #[ORM\Column]
    private ?int $pr_stock = null;

    #[ORM\Column]
    private ?float $pr_precio = null;

    #[ORM\ManyToOne(inversedBy: 'productos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?usuario $usuario = null;

    #[ORM\OneToMany(mappedBy: 'producto', targetEntity: detallecarrito::class, orphanRemoval: true)]
    private Collection $detallecarritos;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $pr_imagenes = null;

    #[ORM\ManyToOne(inversedBy: 'productos')]
    private ?descuento $descuento = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $pr_descripcion = null;

    #[ORM\OneToMany(mappedBy: 'producto', targetEntity: valoracion::class, orphanRemoval: true)]
    private Collection $valoraciones;

    #[ORM\OneToMany(mappedBy: 'producto', targetEntity: detallecompra::class)]
    private Collection $detallecompras;

    #[ORM\OneToMany(mappedBy: 'producto', targetEntity: detallefactura::class)]
    private Collection $detallefacturas;

    public function __construct()
    {
        $this->detallecarritos = new ArrayCollection();
        $this->valoraciones = new ArrayCollection();
        $this->detallecompras = new ArrayCollection();
        $this->detallefacturas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrNombre(): ?string
    {
        return $this->pr_nombre;
    }

    public function setPrNombre(string $pr_nombre): static
    {
        $this->pr_nombre = $pr_nombre;

        return $this;
    }

    public function getPrCategoria(): ?string
    {
        return $this->pr_categoria;
    }

    public function setPrCategoria(string $pr_categoria): static
    {
        $this->pr_categoria = $pr_categoria;

        return $this;
    }

    public function getPrStock(): ?int
    {
        return $this->pr_stock;
    }

    public function setPrStock(int $pr_stock): static
    {
        $this->pr_stock = $pr_stock;

        return $this;
    }

    public function getPrPrecio(): ?float
    {
        return $this->pr_precio;
    }

    public function setPrPrecio(float $pr_precio): static
    {
        $this->pr_precio = $pr_precio;

        return $this;
    }

    public function getUsuario(): ?usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Collection<int, detallecarrito>
     */
    public function getDetallecarritos(): Collection
    {
        return $this->detallecarritos;
    }

    public function addDetallecarrito(detallecarrito $detallecarrito): static
    {
        if (!$this->detallecarritos->contains($detallecarrito)) {
            $this->detallecarritos->add($detallecarrito);
            $detallecarrito->setProducto($this);
        }

        return $this;
    }

    public function removeDetallecarrito(detallecarrito $detallecarrito): static
    {
        if ($this->detallecarritos->removeElement($detallecarrito)) {
            // set the owning side to null (unless already changed)
            if ($detallecarrito->getProducto() === $this) {
                $detallecarrito->setProducto(null);
            }
        }

        return $this;
    }

    public function getPrImagenes(): ?string
    {
        return $this->pr_imagenes;
    }

    public function setPrImagenes(?string $pr_imagenes): static
    {
        $this->pr_imagenes = $pr_imagenes;

        return $this;
    }

    public function getDescuento(): ?descuento
    {
        return $this->descuento;
    }

    public function setDescuento(?descuento $descuento): static
    {
        $this->descuento = $descuento;

        return $this;
    }

    public function getPrDescripcion(): ?string
    {
        return $this->pr_descripcion;
    }

    public function setPrDescripcion(?string $pr_descripcion): static
    {
        $this->pr_descripcion = $pr_descripcion;

        return $this;
    }

    /**
     * @return Collection<int, valoracion>
     */
    public function getValoraciones(): Collection
    {
        return $this->valoraciones;
    }

    public function addValoracione(valoracion $valoracione): static
    {
        if (!$this->valoraciones->contains($valoracione)) {
            $this->valoraciones->add($valoracione);
            $valoracione->setProducto($this);
        }

        return $this;
    }

    public function removeValoracione(valoracion $valoracione): static
    {
        if ($this->valoraciones->removeElement($valoracione)) {
            // set the owning side to null (unless already changed)
            if ($valoracione->getProducto() === $this) {
                $valoracione->setProducto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, detallecompra>
     */
    public function getDetallecompras(): Collection
    {
        return $this->detallecompras;
    }

    public function addDetallecompra(detallecompra $detallecompra): static
    {
        if (!$this->detallecompras->contains($detallecompra)) {
            $this->detallecompras->add($detallecompra);
            $detallecompra->setProducto($this);
        }

        return $this;
    }

    public function removeDetallecompra(detallecompra $detallecompra): static
    {
        if ($this->detallecompras->removeElement($detallecompra)) {
            // set the owning side to null (unless already changed)
            if ($detallecompra->getProducto() === $this) {
                $detallecompra->setProducto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, detallefactura>
     */
    public function getDetallefacturas(): Collection
    {
        return $this->detallefacturas;
    }

    public function addDetallefactura(detallefactura $detallefactura): static
    {
        if (!$this->detallefacturas->contains($detallefactura)) {
            $this->detallefacturas->add($detallefactura);
            $detallefactura->setProducto($this);
        }

        return $this;
    }

    public function removeDetallefactura(detallefactura $detallefactura): static
    {
        if ($this->detallefacturas->removeElement($detallefactura)) {
            // set the owning side to null (unless already changed)
            if ($detallefactura->getProducto() === $this) {
                $detallefactura->setProducto(null);
            }
        }

        return $this;
    }

}
