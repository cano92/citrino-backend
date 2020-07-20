<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Service\ProductService;
use App\Service\CategoryService;
use App\Service\SeasonService;
use App\Service\GenderService;
use App\Service\PaymentService;


class GenericController extends AbstractController
{

    public $productService;
    public $categoryService;
    public $seasonService;
    public $genderService;
    public $paymentService;

    public function __construct(GenderService $genderService,SeasonService $seasonService,
                    CategoryService $categoryService, ProductService $productService, PaymentService $paymentService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->seasonService = $seasonService;
        $this->genderService = $genderService;
        $this->paymentService = $paymentService;

    }


}
