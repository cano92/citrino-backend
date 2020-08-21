<?php

namespace App\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Payment;
use App\Entity\Buy;


class BuyController extends GenericController
{
    /**
     * @Route("/buy", name="buy")
     */
    public function index()
    {
        $listaCompras=$this->buyService->getAll();
        
        return $this->render('buy/index.html.twig', [
            'controller_name' => 'BuyController',
        ]);
    }

     /**
     * @Route("/compras/nueva", name="newBuy")
     */
    public function nuevaCompra( Request $request )
    {
        $data = json_decode($request->getContent(), true);
        // uses request data
        $name = isset($data['name']) ? $data['name'] : null;
        echo "pasa";
        return $this->json($data, 201);
    }

    /**
     * @Route("/compras/iniciar", name="startBuy")
     */
    public function registerNewBuy()
    {
        $payment = $this->paymentService->findId(1);
                    //"compra1","descripcion","modpagoId"
        $buy = new Buy("compra1","descripcion de compra",$payment);

        $this->buyService->save($buy);
        //register Buy in session
        $this->session->set('currentBuy', $buy );

        return $this->render('buy/index.html.twig', [ 'controller_name' => 'BuyController',   ]);
    }

    /**
     * @Route("/compras/finalizar", name="closeBuy")
     */
    public function finalizeNewBuy()
    {   //eliminar la session de la compra
        $this->session->remove("currentBuy");
        //redireccionar
        return $this->render('buy/index.html.twig', [ 'controller_name' => 'BuyController', ]);
    }

    //>>>>>>>>>>>>>><< agregar funcion de perdidas <<<<<<<<<<<
    /**
     * @Route("/compras/listar", name="listBuy")
     */
    public function listAllBuys()
    {   //eliminar la session de la compra 
        $listaCompras=$this->buyService->getAll();
        //redireccionar
        return $this->json($listaCompras, 201);
    }


}
