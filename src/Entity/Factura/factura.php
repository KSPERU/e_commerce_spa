<?php

namespace App\Entity\Factura;

use App\Entity\Compras\compras;
use App\Entity\Usuario\usuario;
use App\Repository\Factura\facturaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: facturaRepository::class)]
class factura
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'factura', cascade: ['persist', 'remove'])]
    private ?compras $compra = null;

    #[ORM\Column(length: 16)]
    private ?string $f_numfactura = null;

    #[ORM\Column]
    private ?int $f_cantidadtotal = null;

    #[ORM\Column]
    private ?float $f_importetotal = null;

    #[ORM\Column(nullable: true)]
    private ?float $f_descuentototal = null;

    #[ORM\Column(nullable: true)]
    private ?float $f_importetotalfinal = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $f_fechacreacion = null;

    #[ORM\OneToMany(mappedBy: 'factura', targetEntity: detallefactura::class, orphanRemoval: true)]
    private Collection $detallefacturas;

    #[ORM\ManyToOne(inversedBy: 'facturas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?usuario $cliente = null;

    public function __construct()
    {
        $this->detallefacturas = new ArrayCollection();
    }

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

    public function getFNumfactura(): ?string
    {
        return $this->f_numfactura;
    }

    public function setFNumfactura(string $f_numfactura): static
    {
        $this->f_numfactura = $f_numfactura;

        return $this;
    }

    public function getFCantidadtotal(): ?int
    {
        return $this->f_cantidadtotal;
    }

    public function setFCantidadtotal(int $f_cantidadtotal): static
    {
        $this->f_cantidadtotal = $f_cantidadtotal;

        return $this;
    }

    public function getFImportetotal(): ?float
    {
        return $this->f_importetotal;
    }

    public function setFImportetotal(float $f_importetotal): static
    {
        $this->f_importetotal = $f_importetotal;

        return $this;
    }

    public function getFDescuentototal(): ?float
    {
        return $this->f_descuentototal;
    }

    public function setFDescuentototal(?float $f_descuentototal): static
    {
        $this->f_descuentototal = $f_descuentototal;

        return $this;
    }

    public function getFImportetotalfinal(): ?float
    {
        return $this->f_importetotalfinal;
    }

    public function setFImportetotalfinal(?float $f_importetotalfinal): static
    {
        $this->f_importetotalfinal = $f_importetotalfinal;

        return $this;
    }

    public function getFFechacreacion(): ?\DateTimeInterface
    {
        return $this->f_fechacreacion;
    }

    public function setFFechacreacion(\DateTimeInterface $f_fechacreacion): static
    {
        $this->f_fechacreacion = $f_fechacreacion;

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
            $detallefactura->setFactura($this);
        }

        return $this;
    }

    public function removeDetallefactura(detallefactura $detallefactura): static
    {
        if ($this->detallefacturas->removeElement($detallefactura)) {
            // set the owning side to null (unless already changed)
            if ($detallefactura->getFactura() === $this) {
                $detallefactura->setFactura(null);
            }
        }

        return $this;
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
}
