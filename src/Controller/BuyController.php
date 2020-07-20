<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BuyController extends AbstractController
{
    /**
     * @Route("/buy", name="buy")
     */
    public function index()
    {
        return $this->render('buy/index.html.twig', [
            'controller_name' => 'BuyController',
        ]);
    }


    //realizar una compra de varios articulos
    // la compra debe llamar al controlador de producto para registrar los productos
    //recibe una lista de articulos de compra

    

}
