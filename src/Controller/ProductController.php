<?php

namespace App\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Gender;
use App\Entity\Season;
use App\Entity\Payment;


class ProductController extends GenericController
{

    //>>>>>>>>>>>>> validar datos de entrada <<<<<<<<<<<<<</


    /**
     * @Route("/product/new", name="newProducto")
     */
    public function registerProduct( )
    {
        //"nombre","modelo","descripcion","codigo","cantidad","precioUnidad","PrecioVenta","temporadaID","GeneroID"
        $product = $this->createProduct("nombre3","model3","descripcion2","cod2",1,100,120,3,1);
        //categorys
        $this->addCategorys( $product,[1,2,20,"as"] );

        $this->productService->save($product);
        //dump($product);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

            //"nombre","modelo","descripcion","codigo","cantidad","precioUnidad","PrecioVenta"
    private function createProduct($name,$model,$description,$cod,$quantity,$unitPrice,$salePrice,      
                            $seasonId,$genderId)
    {
        //inyeccion de dependencies que no sea por parametro
        
        //***** que pasa con ID no validos ******
        $season = $this->seasonService->findId($seasonId);
        $gender = $this->genderService->findId($genderId);
       
        return new Product($name,$model,$description,$cod,$quantity,$unitPrice,$salePrice,$season,$gender);
    }

    private function addCategorys( $product, $listCategorys )
    {
        foreach ($listCategorys as $idCategory)
        {   //cuando no existe ID devuelve null y pasa por falso 
            if( $this->categoryService->findId( $idCategory ) )
            {
                $category = $this->categoryService->findId( $idCategory );
                $product->addCategory($category);
            }
        }
        return $product;
    }


    
}
