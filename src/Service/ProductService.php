<?php

namespace App\Service;

use App\Service\GenericService;

use App\Repository\ProductRepository;
use App\Entity\Product;




class ProductService extends GenericService
{
 
    public function __construct( )
    {   //llama al constructor padre y envia su clase
        parent::__construct(Product::class);
    }


    public function findName($aName):Product
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        //el buscador devuelve un solo resultado
        //busca arreglo clave valor-- si son dos parametros es un and y debe cumplir los dos para devolver resultado
        $product = $repository->findOneBy(['name' => $aName]);
        return $product;
    }

    public function findAllName($aName)
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $listProducts = $repository->findBy(['name' => $aName]);
        return $listProducts;
    }
    

}