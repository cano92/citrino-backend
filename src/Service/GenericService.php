<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class GenericService extends AbstractController
{
    private $type;

    public function __construct( $aType=null)
    {
        $this->type = $aType;
    }

    public function save( $entity )
    { 
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($entity);
        $entityManager->flush();
    }

    public function update( $entity)
    {    
        //recuperar el entity por id, editarlo y volverlo a guardar es suficiente
    }

    public function deleteId($id)
    {
        $entity = $this->findId( $id );
        $this->delete($entity);
    }
    
    public function delete( $entity )
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($entity);
        $entityManager->flush();
    }

    public function findId( $id )
    {
        $repository = $this->getDoctrine()->getRepository( $this->type );
        $entity = $repository->find($id);
        return $entity;
    }

    public function getAll()
    {
        $repository = $this->getDoctrine()->getRepository( $this->type );
        $entities = $repository->findAll();
        return $entities;
    }

}