<?php

namespace App\Entity;

//use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass */
class Transaction
{ 
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $priceTotal;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Payment", cascade={"persist"}, fetch="EAGER")
     */
    private $payment;


    public function __construct($aName=null,$aDescription=null,$aPayment=null)
    {
        $this->setName($aName);
        $this->setDate( new \DateTime("now") );
        $this->setDescription($aDescription);
        $this->setPriceTotal(0);//inicia en cero y suma con add
        $this->setPayment($aPayment);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPriceTotal(): ?int
    {
        return $this->priceTotal;
    }

    public function setPriceTotal(int $priceTotal): self
    {
        $this->priceTotal = $priceTotal;

        return $this;
    }

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function setPayment(?Payment $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

  
}