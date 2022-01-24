<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource]
class Product
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[ORM\ManyToOne(targetEntity : Brand::class, inversedBy: 'products')]
    private $brand;


    #[ORM\Column(type: 'string', length: 155)]
    #[Assert\NotBlank(message: "Nom de marque obligatoire")]
    #[Assert\Length(min: 3, max: 155,minMessage: "Le nom de marque doit faire entre 3 et 155 caractères", maxMessage: "Le nom de marque doit faire entre 3 et 155 caractères")]
    private $name;


    #[ORM\Column(type: 'string', length: 500)]
    #[Assert\NotBlank(message: "Description de marque obligatoire")]
    #[Assert\Length(min: 32, max: 500, minMessage: "La description de marque doit faire entre 32 et 500 caractères", maxMessage: "La description de marque doit faire entre 32 et 500 caractères")]
    private $description;


    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\NotBlank]
    private $imagePath;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'integer')]
    private $stock;


    #[ORM\Column(type: 'boolean', nullable: true)]
    private $active;

    #[ORM\ManyToOne(targetEntity: Discount::class, inversedBy: 'product')]
    private $discount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getDiscount(): ?Discount
    {
        return $this->discount;
    }

    public function setDiscount(?Discount $discount): self
    {
        $this->discount = $discount;

        return $this;
    }
}
