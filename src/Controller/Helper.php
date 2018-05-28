<?php

namespace App\Controller;
use App\Entity\Partie;
use App\Entity\Compte;
use App\Entity\Avatar;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Helper extends Controller{

    /**
     * @Route("/logoutLogin")
     */
    public function logoutLogin(Request $request, SessionInterface $session){
        $session->clear();
        return $this->redirectToRoute("login");
    }
    /**
     * @Route("/logoutCreate")
     */
    public function logoutCreate(Request $request, SessionInterface $session){
        $session->clear();
        return $this->redirectToRoute("create");
    }
}
