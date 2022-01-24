<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
#[ApiResource()]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    #[Assert\NotBlank(message: "Veuillez renseigner un email.")]
    #[Assert\Email(message: "L'adresse email doit être valide.")]
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    #[Assert\NotBlank(message: "Mot de passe obligatoire")]
    #[Assert\Length()]
    private $password;

    /**
     * @ORM\Column(type="string", length=155)
     */
    #[Assert\NotBlank(message: "Nom de famille obligatoire")]
    #[Assert\Length(min: 3, max: 255, minMessage: "Le nom de famille doit faire entre 3 et 32 caractères", maxMessage: "Le nom de famille doit faire entre 3 et 32 caractères")]
    private $lastName;

    /**
     * @ORM\Column(type="string", length=155)
     */
    #[Assert\NotBlank(message: "Prenom obligatoire")]
    #[Assert\Length(min: 3, max: 36, minMessage: "Le prenom doit faire entre 3 et 32 caractères", maxMessage: "Le prenom doit faire entre 3 et 32 caractères")]
    private $firstName;

    /**
     * @ORM\Column(type="string", length=20)
     */
    #[Assert\NotBlank(message: "Veuillez renseigner un numéro.")]
    private $phone;

    /**
     * @ORM\Column(type="date")
     */
    #[Assert\Date()]
    #[Assert\NotBlank()]
    private $creationDate;

    /**
     * @ORM\OneToMany(targetEntity=IPs::class, mappedBy="user", orphanRemoval=true)
     */
    private $IPs;

    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="customer", orphanRemoval=true)
     */
    #[Assert\NotBlank]
    private $addresses;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="customer")
     */
    private $orders;

    public function __construct()
    {
        $this->IPs = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
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

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * @return Collection|IPs[]
     */
    public function getIPs(): Collection
    {
        return $this->IPs;
    }

    public function addIP(IPs $iP): self
    {
        if (!$this->IPs->contains($iP)) {
            $this->IPs[] = $iP;
            $iP->setUser($this);
        }

        return $this;
    }

    public function removeIP(IPs $iP): self
    {
        if ($this->IPs->removeElement($iP)) {
            // set the owning side to null (unless already changed)
            if ($iP->getUser() === $this) {
                $iP->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Address[]
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->setCustomer($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getCustomer() === $this) {
                $address->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setCustomer($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCustomer() === $this) {
                $order->setCustomer(null);
            }
        }

        return $this;
    }
}
