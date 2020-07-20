<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Gender;
use App\Entity\Season;
use App\Entity\Payment;

use App\Service\ProductService;
use App\Service\CategoryService;
use App\Service\SeasonService;
use App\Service\GenderService;
use App\Service\PaymentService;


class DefaultController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {   //login 

       
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    //initialize default objec
    /**
     * @Route("/initialize", name="initialize")
     */
    public function initialze(GenderService $genderService, SeasonService $seasonService,CategoryService $categoryService,
                        PaymentService $paymentService  )
    {
        //Gender
        $masculino = new Gender("Masculino");
        $femenino = new Gender("Femenino");
        $unisex = new Gender("unisex");
        // $genderService->save( $masculino );
        // $genderService->save( $femenino );
        // $genderService->save( $unisex );

        //Season
        $verano = new Season("verano");
        $otoño = new Season("otoño");
        $primavera = new Season("primavera");
        $invierno = new Season("invierno");
        // $seasonService->save( $verano );
        // $seasonService->save( $otoño );
        // $seasonService->save( $primavera );
        // $seasonService->save( $invierno );

        //Category
        $pantalon = new Category("pantalon");
        $pantalonJean = new Category("pantalon-jean");
        $remera = new Category("remera");
        $campera = new Category("campera");  
        // $categoryService->save( $pantalon );
        // $categoryService->save( $pantalonJean );
        // $categoryService->save( $remera );
        // $categoryService->save( $campera );

        //payment
        $efectivo = new Payment("efectivo");
        $tarjeta = new Payment("tarjeta");
        // $paymentService->save( $efectivo );
        // $paymentService->save( $tarjeta );
    


        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/productExample", name="productExample")
     */
    public function product(GenderService $genderService,SeasonService $seasonService,
                        CategoryService $categoryService, ProductService $productService )
    {
        $genero = $genderService->findId(1);
        $temporada = $seasonService->findId(1);

        //"nombre","modelo","descripcion","codigo","cantidad","precioUnidad","PrecioVenta"
        $product1 = new Product("nombre1","model1","descripcion1","cod01",2,100,140,$temporada,$genero);
        
        //categorys
        $category1 = $categoryService->findId(1);
        $category2 = $categoryService->findId(2);

        $product1->addCategory($category1);
        $product1->addCategory($category2);

       
        //$productService->save($product1);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);

    }

    //ejemplo de venta  

    //ejempli de compra

    //recuperar datos  
    //json
}
