<?php

namespace App\Entity\Producto;

use App\Entity\Carrito\detallecarrito;
use App\Entity\Usuario\usuario;
use App\Repository\Producto\productoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    public function __construct()
    {
        $this->detallecarritos = new ArrayCollection();
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
}
