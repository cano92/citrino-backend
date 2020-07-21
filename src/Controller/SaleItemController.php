<?php

namespace App\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\SaleItem;
use App\Entity\Product;

class SaleItemController extends GenericController
{

    /**
     * @Route("/ventas/item/nuevo", name="sale_item")
     */
    public function newSaleItem()
    {
        $sale = $this->session->get('currentSale');
        $this->registerSaleItem( 5, 1,3);

        return $this->render('sale_item/index.html.twig', [
            'controller_name' => 'SaleItemController',
        ]);
    }

    private function registerSaleItem( $productId,$quantity, $saleId )
    {   //revisar que le producto existe y que tiene stock suficiente
        $product = $this->productService->findId($productId);

        if( $product && $product->getStock() >= $quantity )
        {   
            $sale = $this->saleService->findId($saleId);

            //en el constructor de SALEITEM seactualiza el stock
            $saleItem = new SaleItem($product, $quantity, $product->getSalePrice()*$quantity,$sale );
            $this->saleItemService->save( $saleItem );
    
            //update Sale PriceTotal
            $sale->setPriceTotal( $sale->getPriceTotal( )+($product->getSalePrice()*$quantity) );
            $this->saleService->save($sale);
        }

    }

    // devolver --
    


}
