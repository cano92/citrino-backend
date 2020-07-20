<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", cascade={"persist"}, fetch="EAGER")
     */
    private $categorys;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Season", fetch="EAGER")
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Gender", fetch="EAGER")
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="integer")
     */
    private $buyQuantity;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="integer")
     */
    private $unitPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $salePrice;

     //"nombre","modelo","descripcion","codigo","cantidad","precioUnidad","PrecioVenta"
    //"Season{verano,invierno..}","Gender{hombre,mujer,unisex}"
    public function __construct($name=null,$model=null,$description=null,$code=null,
                        $buyQuantity=null,$unitPrice=null,$salePrice=null,      
                        $season=null,$gender=null)
    {
        $this->setName($name);
        $this->setModel($model);
        $this->setDescription($description);
        $this->setCode($code);
        
        $this->setBuyQuantity($buyQuantity);
        $this->setStock($buyQuantity);
        $this->setUnitPrice($unitPrice);
        $this->setSalePrice($salePrice);

        $this->setSeason($season);
        $this->setGender($gender);
        
        $this->categorys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): self
    {
        $this->gender = $gender;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getBuyQuantity(): ?int
    {
        return $this->buyQuantity;
    }

    public function setBuyQuantity(int $buyQuantity): self
    {
        $this->buyQuantity = $buyQuantity;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getUnitPrice(): ?int
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(int $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getSalePrice(): ?int
    {
        return $this->salePrice;
    }

    public function setSalePrice(int $salePrice): self
    {
        $this->salePrice = $salePrice;

        return $this;
    }

    /**
    * @return Collection|Category[]
    */
    public function getCategorys()
    {   //retorna un arreglo sencillo con las categorias y no commonCollection
        return $this->categorys->getValues();
    }

    public function addCategory(?Category $aCategory): self
    {   //produce error agregar dos veces el mismo elemento en la DB
        //elimina duplicados en categorias
        if( !$this->categorys->contains($aCategory) )
        {
            $this->categorys->add($aCategory);
        }
        return $this;
    }

    public function removeCategory(?Category $aCategory)
    {
        $this->categorys->removeElement($aCategory);
    }

    public function removeAllCategorys()
    {
        $this->categorys->clear();
    }

    public function isIncludeCategory( $aCategory )
    {
        return $this->categorys->contains($aCategory);
    }


}