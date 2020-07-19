<?php

namespace App\Service;

use App\Service\GenericService;

use App\Entity\Payment;


class PaymentService extends GenericService
{

    public function __construct( )
    {   //llama al constructor padre y envia su clase
        parent::__construct(Payment::class);
    }


}