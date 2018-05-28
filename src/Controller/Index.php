<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Avatar;

class Index extends Controller{
    /**
     * @Route("/")
     * @Route("/index")
     */
    public function index(){

        return $this->render('index.html.twig',
            array());
    }
}
