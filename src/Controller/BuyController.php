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
}
