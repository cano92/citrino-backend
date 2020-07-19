<?php

namespace App\Entity;

use App\Repository\BuyRepository;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Transaction;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=BuyRepository::class)
 */
class Buy extends Transaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", cascade={"persist"}, fetch="EAGER")
     */
    private $listProducts;

    public function __construct($aName=null,$aDescription=null,$aPayment=null)
    {
        parent::__construct($aName,$aDescription,$aPayment);
        $this->listProducts = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Product[]
     */
    public function getListProducts()
    {
        return $this->listProducts->getValues();
    }

    public function addProduct(?Product $aProduct): self
    {   //produce error agregar dos veces el mismo elemento en la DB
        if( !$this->listProducts->contains($aProduct) )
        {
            $this->listProducts->add($aProduct);
            $sumPrice = $aProduct->getUnitPrice() * $aProduct->getBuyQuantity();
            $amount = $this->getPriceTotal() + $sumPrice;
            $this->setPriceTotal($amount);
        }
        return $this;
    }

    public function removeProduct(?Category $aProduct)
    {
        $this->listProducts->removeElement($aProduct);
        $sumPrice = $aProduct->getUnitPrice() * $aProduct->getBuyQuantity();
        $amount = $this->getPriceTotal() - $sumPrice;
    }

    public function removeAllProducts()
    {
        $this->listProducts->clear();
        $this->setPriceTotal(0);
    }


    
}