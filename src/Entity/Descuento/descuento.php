<?php

namespace App\Entity\Descuento;

use App\Entity\Producto\producto;
use App\Repository\Descuento\descuentoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: descuentoRepository::class)]
class descuento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $ds_codigo = null;

    #[ORM\Column]
    private ?float $ds_valor = null;

    #[ORM\Column]
    private ?bool $ds_estado = null;

    #[ORM\OneToMany(mappedBy: 'descuento', targetEntity: producto::class)]
    private Collection $productos;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDsCodigo(): ?string
    {
        return $this->ds_codigo;
    }

    public function setDsCodigo(string $ds_codigo): static
    {
        $this->ds_codigo = $ds_codigo;

        return $this;
    }

    public function getDsValor(): ?float
    {
        return $this->ds_valor;
    }

    public function setDsValor(float $ds_valor): static
    {
        $this->ds_valor = $ds_valor;

        return $this;
    }

    public function isDsEstado(): ?bool
    {
        return $this->ds_estado;
    }

    public function setDsEstado(bool $ds_estado): static
    {
        $this->ds_estado = $ds_estado;

        return $this;
    }

    /**
     * @return Collection<int, producto>
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(producto $producto): static
    {
        if (!$this->productos->contains($producto)) {
            $this->productos->add($producto);
            $producto->setDescuento($this);
        }

        return $this;
    }

    public function removeProducto(producto $producto): static
    {
        if ($this->productos->removeElement($producto)) {
            // set the owning side to null (unless already changed)
            if ($producto->getDescuento() === $this) {
                $producto->setDescuento(null);
            }
        }

        return $this;
    }

}
