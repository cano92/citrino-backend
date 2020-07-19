<?php

namespace App\Entity;

use App\Repository\SaleRepository;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Transaction;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=SaleRepository::class)
 */
class Sale extends Transaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SaleItem", cascade={"persist"}, fetch="EAGER")
     */
    private $listItems;

    public function __construct($aName=null,$aDescription=null,$aPayment=null)
    {

        parent::__construct($aName,$aDescription,$aPayment);
        $this->listItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

        /**
     * @return Collection|Product[]
     */
    public function getListItems()
    {
        return $this->listItems->getValues();
    }

    public function addItem(?SaleItem $aItem): self
    {   //produce error agregar dos veces el mismo elemento en la DB
        if( !$this->listItems->contains($aItem) )
        {//agrega item y suma precioTotal
            $this->listItems->add($aItem);
            $sum = $aItem->getAmount() * $aItem->getQuantity();
            $amount = $this->getPriceTotal() + $sum;
            $this->setPriceTotal( $amount);
        }
        return $this;
    }

    public function removeItem(?Category $aItem)
    { //al remover el item restar el precio total
        $this->listItems->removeElement($aItem);
        $amount = $this->getPriceTotal() - $aItem->getAmount();
        $this->setPriceTotal( $amount);
    }

    public function removeAllProducts()
    {
        $this->listItems->clear();
        $this->setPriceTotal( 0);
    }

}