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
     * @ORM\Column(type="date")
     */
    private $date;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", fetch="EAGER")
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

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sale", fetch="EAGER")
     */
    private $sale;

    /**
     * @ORM\Column(type="integer")
     */
    private $repaymentQuantity;


    public function __construct( $aProduct=null, $aQuantity=null, $aAmount=null, $aSale=null )
    {
        $this->setProduct($aProduct);
        $this->setQuantity($aQuantity);

        $this->setDate( new \DateTime("now") );

        //resta stock de producto--tener cuidado de no quedar con stock neg
        $currentStock = $aProduct->getStock() - $aQuantity;
        $aProduct->setStock($currentStock);
        $this->setAmount($aAmount);

        $this->setSale($aSale);
        $this->setRepaymentQuantity(0); //devoluciones
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getSale(): ?Sale
    {
        return $this->sale;
    }

    public function setSale(Sale $sale): self
    {
        $this->sale = $sale;

        return $this;
    }
    
    public function setRepaymentQuantity(int $repaymentQuantity ):self
    {
        $this->repaymentQuantity = $repaymentQuantity;

        return $this;
    }

    public function getRepaymentQuantity(): ?int
    {
        return $this->repaymentQuantity;
    }

}
