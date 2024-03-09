<?php

namespace App\Entity\Compras;

use App\Entity\Factura\factura;
use App\Entity\Usuario\usuario;
use App\Repository\Compras\comprasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: comprasRepository::class)]
class compras
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'compras')]
    #[ORM\JoinColumn(nullable: false)]
    private ?usuario $cliente = null;

    #[ORM\Column]
    private ?int $cm_cantidadtotal = null;

    #[ORM\Column]
    private ?float $cm_importetotal = null;

    #[ORM\OneToMany(mappedBy: 'compra', targetEntity: detallecompra::class, orphanRemoval: true)]
    private Collection $detallecompras;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $cm_fechacompra = null;

    #[ORM\Column(nullable: true)]
    private ?float $cm_descuentototal = null;

    #[ORM\Column(nullable: true)]
    private ?float $cm_importetotalfinal = null;

    #[ORM\OneToOne(mappedBy: 'compra', cascade: ['persist', 'remove'])]
    private ?factura $factura = null;

    public function __construct()
    {
        $this->detallecompras = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCliente(): ?usuario
    {
        return $this->cliente;
    }

    public function setCliente(?usuario $cliente): static
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getCmCantidadtotal(): ?int
    {
        return $this->cm_cantidadtotal;
    }

    public function setCmCantidadtotal(int $cm_cantidadtotal): static
    {
        $this->cm_cantidadtotal = $cm_cantidadtotal;

        return $this;
    }

    public function getCmImportetotal(): ?float
    {
        return $this->cm_importetotal;
    }

    public function setCmImportetotal(float $cm_importetotal): static
    {
        $this->cm_importetotal = $cm_importetotal;

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
            $detallecompra->setCompra($this);
        }

        return $this;
    }

    public function removeDetallecompra(detallecompra $detallecompra): static
    {
        if ($this->detallecompras->removeElement($detallecompra)) {
            // set the owning side to null (unless already changed)
            if ($detallecompra->getCompra() === $this) {
                $detallecompra->setCompra(null);
            }
        }

        return $this;
    }

    public function getCmFechacompra(): ?\DateTimeInterface
    {
        return $this->cm_fechacompra;
    }

    public function setCmFechacompra(\DateTimeInterface $cm_fechacompra): static
    {
        $this->cm_fechacompra = $cm_fechacompra;

        return $this;
    }

    public function getCmDescuentototal(): ?float
    {
        return $this->cm_descuentototal;
    }

    public function setCmDescuentototal(?float $cm_descuentototal): static
    {
        $this->cm_descuentototal = $cm_descuentototal;

        return $this;
    }

    public function getCmImportetotalfinal(): ?float
    {
        return $this->cm_importetotalfinal;
    }

    public function setCmImportetotalfinal(?float $cm_importetotalfinal): static
    {
        $this->cm_importetotalfinal = $cm_importetotalfinal;

        return $this;
    }

    public function getFactura(): ?factura
    {
        return $this->factura;
    }

    public function setFactura(?factura $factura): static
    {
        // unset the owning side of the relation if necessary
        if ($factura === null && $this->factura !== null) {
            $this->factura->setCompra(null);
        }

        // set the owning side of the relation if necessary
        if ($factura !== null && $factura->getCompra() !== $this) {
            $factura->setCompra($this);
        }

        $this->factura = $factura;

        return $this;
    }
}
