<?php

namespace App\Service;
use App\Service\GenericService;

use App\Entity\Category;


class CategoryService extends GenericService
{

    public function __construct( )
    {   //llama al constructor padre y envia su clase
        parent::__construct(Category::class);
    }
  

}