<?php

namespace App\Entity;

use App\Repository\BuyRepository;
use Doctrine\ORM\Mapping as ORM;

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


    public function __construct($aName=null,$aDescription=null,$aPayment=null)
    {
        parent::__construct($aName,$aDescription,$aPayment);
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    
}