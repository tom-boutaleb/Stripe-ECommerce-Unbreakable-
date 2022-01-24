<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
#[ApiResource]
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="addresses")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Assert\NotBlank]
    private $customer;

    /**
     * @ORM\Column(type="string", length=155)
     */
    #[Assert\NotBlank(message: "Nom de famille obligatoire")]
    #[Assert\Length(min: 3, max: 255, minMessage: "Le nom de famille doit faire entre 3 et 32 caractères", maxMessage: "Le nom de famille doit faire entre 3 et 32 caractères")]
    private $lastName;

    /**
     * @ORM\Column(type="string", length=155)
     */
    #[Assert\NotBlank(message: "Prénom obligatoire")]
    #[Assert\Length(min: 3, max: 255, minMessage: "Le prénom doit faire entre 3 et 32 caractères", maxMessage: "Le prénom faire entre 3 et 32 caractères")]
    private $firstName;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    #[Assert\NotBlank(message: "Numéro de rue obligatoire")]
    private $streetNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Assert\NotBlank(message: "Nom de rue obligatoire")]
    private $streetName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $streetAddition;

    /**
     * @ORM\Column(type="integer")
     */
    #[Assert\NotBlank(message:"Code postal obligatoire")]
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=80)
     */
    #[Assert\NotBlank(message: "Nom de ville obligatoire")]
    private $city;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $main;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?User
    {
        return $this->customer;
    }

    public function setCustomer(?User $customer): self
    {
        $this->customer = $customer;

        return $this;
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

    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(?string $streetNumber): self
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    public function getStreetName(): ?string
    {
        return $this->streetName;
    }

    public function setStreetName(string $streetName): self
    {
        $this->streetName = $streetName;

        return $this;
    }

    public function getStreetAddition(): ?string
    {
        return $this->streetAddition;
    }

    public function setStreetAddition(?string $streetAddition): self
    {
        $this->streetAddition = $streetAddition;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getMain(): ?bool
    {
        return $this->main;
    }

    public function setMain(?bool $main): self
    {
        $this->main = $main;

        return $this;
    }
}
