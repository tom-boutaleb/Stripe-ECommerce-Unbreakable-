<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Float_;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: OrderDetailRepository::class)]
#[ApiResource]
class OrderDetail
{

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private $order;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[ORM\OneToOne(targetEntity: Product::class, cascade: ['persist', 'remove'])]
    private $product;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: "La quantité doit être renseignée")]
    #[Assert\Type(type: "int")]
    private $productQuantity;


    #[ORM\Column(type: 'float')]
    #[Assert\Type(type: "float")]
    #[Assert\NotBlank(message: "Le total doit être renseigné")]
    private $total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getProductQuantity(): ?int
    {
        return $this->productQuantity;
    }

    public function setProductQuantity(int $productQuantity): self
    {
        $this->productQuantity = $productQuantity;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }
}
