<?php

namespace App\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Gender;
use App\Entity\Season;
use App\Entity\Payment;



class DefaultController extends GenericController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {   
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    //initialize default objec
    /**
     * @Route("/initialize", name="initialize")
     */
    public function initialze(  )
    {
        //Gender
        $masculino = new Gender("Masculino");
        $femenino = new Gender("Femenino");
        $unisex = new Gender("unisex");
        $this->genderService->save( $masculino );
        $this->genderService->save( $femenino );
        $this->genderService->save( $unisex );

        //Season
        $verano = new Season("verano");
        $otoño = new Season("otoño");
        $primavera = new Season("primavera");
        $invierno = new Season("invierno");
        $this->seasonService->save( $verano );
        $this->seasonService->save( $otoño );
        $this->seasonService->save( $primavera );
        $this->seasonService->save( $invierno );

        //Category
        $pantalon = new Category("pantalon");
        $pantalonJean = new Category("pantalon-jean");
        $remera = new Category("remera");
        $campera = new Category("campera");  
        $this->categoryService->save( $pantalon );
        $this->categoryService->save( $pantalonJean );
        $this->categoryService->save( $remera );
        $this->categoryService->save( $campera );

        //payment
        $efectivo = new Payment("efectivo");
        $tarjeta = new Payment("tarjeta");
        $this->paymentService->save( $efectivo );
        $this->paymentService->save( $tarjeta );
    


        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

 
}
