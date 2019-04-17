<?php


namespace AppBundle\Service;


use Doctrine\ORM\EntityManagerInterface;

class PokemonService
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function save($pokemon)
    {
        $this->em->persist($pokemon);
        $this->em->flush();
    }



}