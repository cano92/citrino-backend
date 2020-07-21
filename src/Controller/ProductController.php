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
     * @Route("/producto/nuevo", name="newProducto")
     */
    public function registerProduct( )
    {
        //"nombre","modelo","descripcion","codigo","cantidad","precioUnidad","PrecioVenta","temporadaID","GeneroID","compraID"
        $product = $this->createProduct("nombre5","model5","descripcion5","cod5",2,100,120,3,1,1);
        //categorys
        $this->addCategorys( $product,[1,2,20,"as"] );

        $this->productService->save($product);
        
        $this->updatePriceTotalBuy(200);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

            //"nombre","modelo","descripcion","codigo","cantidad","precioUnidad","PrecioVenta"
    private function createProduct($name,$model,$description,$cod,$quantity,$unitPrice,$salePrice,      
                            $seasonId,$genderId,$buyId)
    {
        $season = $this->seasonService->findId($seasonId);
        $gender = $this->genderService->findId($genderId);
        $buy = $this->buyService->findId($genderId);
       
        return new Product($name,$model,$description,$cod,$quantity,$unitPrice,$salePrice,$season,$gender,$buy);
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

    private function updatePriceTotalBuy( $price )
    {   //buy de session no es el mismo obj de la DB (en vez de actualizar crea otro obj)
        $buy = $this->session->get('currentBuy');

        $currentBuy = $this->buyService->findId( $buy->getId() );

        $currentBuy->sumPriceTotal( $price );
        $this->buyService->save($currentBuy);
    } 

    //--devoluciones nose puede devolver mas cantidad que la que tenga en stock
    // de lo contrario esta devolviendo lo que no tiene
    //hay que indicar que producto se esta devolviendo y que cantidad de elementos



    
    //*****  editar producto


}
