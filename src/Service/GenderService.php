<?php

namespace App\Service;

use App\Service\GenericService;

use App\Entity\Gender;


class GenderService extends GenericService
{

    public function __construct( )
    {   //llama al constructor padre y envia su clase
        parent::__construct(Gender::class);
    }


}