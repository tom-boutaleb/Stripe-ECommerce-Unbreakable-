<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DiscountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=DiscountRepository::class)
 */
class Discount
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="discount")
     */
    private $productId;

    /**
     * @ORM\Column(type="string", length=155)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $percentage;

    /**
     * @ORM\Column(type="date")
     */
    private $startingDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endingDate;

    public function __construct()
    {
        $this->productId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProductId(): Collection
    {
        return $this->productId;
    }

    public function addProductId(Product $productId): self
    {
        if (!$this->productId->contains($productId)) {
            $this->productId[] = $productId;
            $productId->setDiscount($this);
        }

        return $this;
    }

    public function removeProductId(Product $productId): self
    {
        if ($this->productId->removeElement($productId)) {
            // set the owning side to null (unless already changed)
            if ($productId->getDiscount() === $this) {
                $productId->setDiscount(null);
            }
        }

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

    public function getPercentage(): ?float
    {
        return $this->percentage;
    }

    public function setPercentage(float $percentage): self
    {
        $this->percentage = $percentage;

        return $this;
    }

    public function getStartingDate(): ?\DateTimeInterface
    {
        return $this->startingDate;
    }

    public function setStartingDate(\DateTimeInterface $startingDate): self
    {
        $this->startingDate = $startingDate;

        return $this;
    }

    public function getEndingDate(): ?\DateTimeInterface
    {
        return $this->endingDate;
    }

    public function setEndingDate(\DateTimeInterface $endingDate): self
    {
        $this->endingDate = $endingDate;

        return $this;
    }
}
