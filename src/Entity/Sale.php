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


    public function __construct($aName=null,$aDescription=null,$aPayment=null)
    {
        parent::__construct($aName,$aDescription,$aPayment);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

}