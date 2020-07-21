<?php

namespace App\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Payment;
use App\Entity\Sale;


class SaleController extends GenericController
{
    /**
     * @Route("/sale", name="sale")
     */
    public function index()
    {
        return $this->render('sale/index.html.twig', [
            'controller_name' => 'SaleController',
        ]);
    }

    /**
     * @Route("/ventas/iniciar", name="startSale")
     */
    public function newSale()
    {
        $payment = $this->paymentService->findId(1);
                    //"compra1","descripcion","modpagoId"
        $sale = new Sale("venta1","descripcion de venta 1",$payment);
        $this->saleService->save($sale);
        //register Buy in session
        $this->session->set('currentSale', $sale );


        return $this->render('sale/index.html.twig', [ 'controller_name' => 'SaleController', ]);
    }

    /**
     * @Route("/ventas/finalizar", name="closeSale")
     */
    public function finalizeNewBuy()
    {   //eliminar la session de la compra
        $this->session->remove("currentSale");
        //redireccionar
        return $this->render('sale/index.html.twig', [ 'controller_name' => 'SaleController', ]);
    }


}
