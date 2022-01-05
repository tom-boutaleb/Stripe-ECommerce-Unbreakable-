<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext={"groups"={"order_details_read"}},
 *  denormalizationContext={"groups"={"order_details_write"}}
 * )
 * @ORM\Entity(repositoryClass=OrderDetailRepository::class)
 */
class OrderDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"order_details_read", "order_details_write", "orders_write", "orders_read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderDetails", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"order_details_read", "order_details_write", "orders_write", "orders_read"})
     */
    private $order;

    /**
     * @ORM\OneToOne(targetEntity=Product::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"order_details_read", "order_details_write", "orders_write", "orders_read"})
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"order_details_read", "order_details_write", "orders_write", "orders_read"})
     */
    private $productQuantity;

    /**
     * @ORM\Column(type="float")
     * @Groups({"order_details_read", "order_details_write", "orders_write", "orders_read"})
     */
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
