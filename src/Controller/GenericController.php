<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Service\ProductService;
use App\Service\CategoryService;
use App\Service\SeasonService;
use App\Service\GenderService;
use App\Service\PaymentService;
use App\Service\BuyService;
use App\Service\SaleService;
use App\Service\SaleItemService;


class GenericController extends AbstractController
{

    public $productService;
    public $categoryService;
    public $seasonService;
    public $genderService;
    public $paymentService;
    public $buyService;
    public $saleService;
    public $saleItemService;

    public $session;

    public function __construct(GenderService $genderService,SeasonService $seasonService,CategoryService $categoryService, 
                ProductService $productService, PaymentService $paymentService,BuyService $buyService,
                SaleService $saleService,SaleItemService $saleItemService, SessionInterface $session)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->seasonService = $seasonService;
        $this->genderService = $genderService;
        $this->paymentService = $paymentService;
        $this->buyService = $buyService;
        $this->saleService = $saleService;
        $this->saleItemService = $saleItemService;

        $this->session = $session;
    }


}
