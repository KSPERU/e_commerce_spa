<?php

namespace App\Entity\Carrito;

use App\Entity\Usuario\usuario;
use App\Repository\Carrito\carritoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: carritoRepository::class)]
class carrito
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'carrito', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?usuario $usuario = null;

    #[ORM\Column]
    private ?int $c_cantidadtotal = null;

    #[ORM\Column]
    private ?float $c_importetotal = null;

    #[ORM\OneToMany(mappedBy: 'carrito', targetEntity: detallecarrito::class, orphanRemoval: true)]
    private Collection $detallescarrito;

    #[ORM\Column(nullable: true)]
    private ?float $c_descuentototal = null;

    #[ORM\Column(nullable: true)]
    private ?float $c_importetotalfinal = null;

    public function __construct()
    {
        $this->detallescarrito = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?usuario
    {
        return $this->usuario;
    }

    public function setUsuario(usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getCCantidadtotal(): ?int
    {
        return $this->c_cantidadtotal;
    }

    public function setCCantidadtotal(int $c_cantidadtotal): static
    {
        $this->c_cantidadtotal = $c_cantidadtotal;

        return $this;
    }

    public function getCImportetotal(): ?float
    {
        return $this->c_importetotal;
    }

    public function setCImportetotal(float $c_importetotal): static
    {
        $this->c_importetotal = $c_importetotal;

        return $this;
    }

    /**
     * @return Collection<int, detallecarrito>
     */
    public function getDetallescarrito(): Collection
    {
        return $this->detallescarrito;
    }

    public function addDetallescarrito(detallecarrito $detallescarrito): static
    {
        if (!$this->detallescarrito->contains($detallescarrito)) {
            $this->detallescarrito->add($detallescarrito);
            $detallescarrito->setCarrito($this);
        }

        return $this;
    }

    public function removeDetallescarrito(detallecarrito $detallescarrito): static
    {
        if ($this->detallescarrito->removeElement($detallescarrito)) {
            // set the owning side to null (unless already changed)
            if ($detallescarrito->getCarrito() === $this) {
                $detallescarrito->setCarrito(null);
            }
        }

        return $this;
    }

    public function getCDescuentototal(): ?float
    {
        return $this->c_descuentototal;
    }

    public function setCDescuentototal(?float $c_descuentototal): static
    {
        $this->c_descuentototal = $c_descuentototal;

        return $this;
    }

    public function getCImportetotalfinal(): ?float
    {
        return $this->c_importetotalfinal;
    }

    public function setCImportetotalfinal(?float $c_importetotalfinal): static
    {
        $this->c_importetotalfinal = $c_importetotalfinal;

        return $this;
    }
}
