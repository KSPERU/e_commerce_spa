<?php

namespace App\Entity\Usuario;

use App\Entity\Carrito\carrito;
use App\Entity\Compras\compras;
use App\Entity\Factura\factura;
use App\Entity\Producto\producto;
use App\Entity\Valoracion\valoracion;
use App\Repository\Usuario\usuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: usuarioRepository::class)]
#[UniqueEntity(fields: ['u_correo'], message: 'There is already an account with this u_correo')]
class usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $u_correo = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    private ?string $u_nombres = null;

    #[ORM\Column(length: 50)]
    private ?string $u_apepat = null;

    #[ORM\Column(length: 50)]
    private ?string $u_apemat = null;

    #[ORM\Column(length: 8)]
    private ?string $u_dni = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $u_telefono = null;

    #[ORM\Column]
    private ?bool $u_estado = null;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: producto::class, orphanRemoval: true)]
    private Collection $productos;

    #[ORM\OneToOne(mappedBy: 'usuario', cascade: ['persist', 'remove'])]
    private ?carrito $carrito = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $googleId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $facebookId = null;
    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: valoracion::class, orphanRemoval: true)]
    private Collection $valoraciones;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: compras::class)]
    private Collection $compras;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: factura::class)]
    private Collection $facturas;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
        $this->valoraciones = new ArrayCollection();
        $this->compras = new ArrayCollection();
        $this->facturas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUCorreo(): ?string
    {
        return $this->u_correo;
    }

    public function setUCorreo(string $u_correo): static
    {
        $this->u_correo = $u_correo;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->u_correo;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUNombres(): ?string
    {
        return $this->u_nombres;
    }

    public function setUNombres(string $u_nombres): static
    {
        $this->u_nombres = $u_nombres;

        return $this;
    }

    public function getUApepat(): ?string
    {
        return $this->u_apepat;
    }

    public function setUApepat(string $u_apepat): static
    {
        $this->u_apepat = $u_apepat;

        return $this;
    }

    public function getUApemat(): ?string
    {
        return $this->u_apemat;
    }

    public function setUApemat(string $u_apemat): static
    {
        $this->u_apemat = $u_apemat;

        return $this;
    }

    public function getUDni(): ?string
    {
        return $this->u_dni;
    }

    public function setUDni(string $u_dni): static
    {
        $this->u_dni = $u_dni;

        return $this;
    }

    public function getUTelefono(): ?string
    {
        return $this->u_telefono;
    }

    public function setUTelefono(?string $u_telefono): static
    {
        $this->u_telefono = $u_telefono;

        return $this;
    }

    public function isUEstado(): ?bool
    {
        return $this->u_estado;
    }

    public function setUEstado(bool $u_estado): static
    {
        $this->u_estado = $u_estado;

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
            $producto->setUsuario($this);
        }

        return $this;
    }

    public function removeProducto(producto $producto): static
    {
        if ($this->productos->removeElement($producto)) {
            // set the owning side to null (unless already changed)
            if ($producto->getUsuario() === $this) {
                $producto->setUsuario(null);
            }
        }

        return $this;
    }

    public function getCarrito(): ?carrito
    {
        return $this->carrito;
    }

    public function setCarrito(carrito $carrito): static
    {
        // set the owning side of the relation if necessary
        if ($carrito->getUsuario() !== $this) {
            $carrito->setUsuario($this);
        }

        $this->carrito = $carrito;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getGoogleId(): ?string
    {
        return $this->googleId;
    }

    public function setGoogleId(?string $googleId): static
    {
        $this->googleId = $googleId;

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
            $valoracione->setUsuario($this);
        }

        return $this;
    }

    public function getFacebookId(): ?string
    {
        return $this->facebookId;
    }

    public function setFacebookId(?string $facebookId): static
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    public function removeValoracione(valoracion $valoracione): static
    {
        if ($this->valoraciones->removeElement($valoracione)) {
            // set the owning side to null (unless already changed)
            if ($valoracione->getUsuario() === $this) {
                $valoracione->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, compras>
     */
    public function getCompras(): Collection
    {
        return $this->compras;
    }

    public function addCompra(compras $compra): static
    {
        if (!$this->compras->contains($compra)) {
            $this->compras->add($compra);
            $compra->setCliente($this);
        }

        return $this;
    }

    public function removeCompra(compras $compra): static
    {
        if ($this->compras->removeElement($compra)) {
            // set the owning side to null (unless already changed)
            if ($compra->getCliente() === $this) {
                $compra->setCliente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, factura>
     */
    public function getFacturas(): Collection
    {
        return $this->facturas;
    }

    public function addFactura(factura $factura): static
    {
        if (!$this->facturas->contains($factura)) {
            $this->facturas->add($factura);
            $factura->setCliente($this);
        }

        return $this;
    }

    public function removeFactura(factura $factura): static
    {
        if ($this->facturas->removeElement($factura)) {
            // set the owning side to null (unless already changed)
            if ($factura->getCliente() === $this) {
                $factura->setCliente(null);
            }
        }

        return $this;
    }
}
