<?php

namespace App\Entity\Valoracion;

use App\Entity\Producto\producto;
use App\Entity\Usuario\usuario;
use App\Repository\Valoracion\valoracionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: valoracionRepository::class)]
class valoracion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'valoraciones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?producto $producto = null;

    #[ORM\ManyToOne(inversedBy: 'valoraciones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?usuario $usuario = null;

    #[ORM\Column]
    private ?int $vl_valor = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $vl_comentario = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUsuario(): ?usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getVlValor(): ?int
    {
        return $this->vl_valor;
    }

    public function setVlValor(int $vl_valor): static
    {
        $this->vl_valor = $vl_valor;

        return $this;
    }

    public function getVlComentario(): ?string
    {
        return $this->vl_comentario;
    }

    public function setVlComentario(?string $vl_comentario): static
    {
        $this->vl_comentario = $vl_comentario;

        return $this;
    }
}
