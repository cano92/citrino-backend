<?php

namespace App\Entity;

use App\Repository\SaleItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SaleItemRepository::class)
 */
class SaleItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", cascade={"persist"}, fetch="EAGER")
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;


    public function __construct( $aProduct=null, $aQuantity=null, $aAmount=null )
    {
        $this->setProduct($aProduct);
        $this->setQuantity($aQuantity);
        //resta stock de producto--tener cuidado de no quedar con stock neg
        $currentStock = $aProduct->getStock() - $aQuantity;
        $aProduct->setStock($currentStock);
        $this->setAmount($aAmount);
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
