<?php

namespace App\Controller;
use App\Entity\Avatar;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Index extends Controller{

    /**
     * @Route("/")
     * @Route("/index")
     */
    public function index(Request $request, SessionInterface $session){
        if($session->get("user")){
            return $this->redirectToRoute("choixperso");
        };
        return $this->render('index.html.twig',
            array());
    }
}
