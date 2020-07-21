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
    {   // recuperar el ID de la compra
        $buy = $this->session->get('currentBuy');

        //"nombre","modelo","descripcion","codigo","cantidad","precioUnidad","PrecioVenta","temporadaID","GeneroID","compraID"
        $product = $this->createProduct("nombre 6","model 6","descripcion 6","cod6",2,100,120,3,1, $buy->getId() );
        //categorys
        $this->addCategorys( $product,[1,2,20,"as"] );

        $this->productService->save($product);
        // la compra y el monto a modificar
        $this->updatePriceTotalBuy($buy->getId(), 200);

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
        $buy = $this->buyService->findId($buyId);
       
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

    private function updatePriceTotalBuy(int $buyId, int $price )
    {   //$buy de session no es el mismo obj de la DB (en vez de actualizar crea otro obj)
        $currentBuy = $this->buyService->findId( $buyId );

        $currentBuy->updatePriceTotal( $price );
        $this->buyService->save($currentBuy);
    } 

    //--devoluciones nose puede devolver mas cantidad que la que tenga en stock
    //hay que indicar que producto se esta devolviendo y que cantidad de elementos

    /**
     * @Route("/producto/devuelto", name="repayment")
     */
    public function repaymentProduct()
    {
        $buy = $this->session->get('currentBuy');

        //--- ID Producto y cantidad a devolver
        $this->updateRepaymentProduct(19, 1 );

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    private function updateRepaymentProduct(int  $idProduct, int $quantity)
    {
        $product = $this->productService->findId( $idProduct );


        if( $product->getStock() >= $quantity )
        {   // update product stock and repayment
            $product->setStock( $product->getStock() - $quantity);
            $product->setRepaymentQuantity( $product->getRepaymentQuantity() + $quantity );
            $this->productService->save($product);
            
            //update buy
            $buy = $this->buyService->findId( $product->getBuy() );
            $this->updatePriceTotalBuy($buy->getId(),-( $quantity * $product->getUnitPrice() ) );
        }
    }


    //*****  editar producto


}
