<?php

namespace App\Controller;

use App\Entity\Compte;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Form\Type\LoginType;
use Symfony\Component\HttpFoundation\RedirectResponse;


class Login extends Controller{
    /**
     * @Route("/login")
     */
    public function index(Request $request, SessionInterface $session){
        if($session->get("user")){
            return $this->redirectToRoute("choixperso");
        }
        $log = new Compte();
        $login = $this->createForm(LoginType::class);

        $login->handleRequest($request);
        if($login->isSubmitted() && $login->isValid()){
            $loginFormData = $login->getData();
            $check = $this
                ->getDoctrine()
                ->getRepository(Compte::class)
                ->findAll();

            foreach($check as $j){
                if(strcmp($j->getPseudo(), $loginFormData['pseudo']) == 0 &&
                    strcmp($j->getPassword(), $loginFormData['password']) == 0){
                        $validPseudo = true;
                        $session->set("user", $loginFormData['pseudo']);
                        return $this->redirectToRoute("choixperso");
                }
            }

            return $this->render('login.html.twig', array(
                    'login'=>$login->createView(),
                    'validPseudo'=>false)
                );
        }

        return $this->render('login.html.twig', array(
                'login'=>$login->createView(),
                'validPseudo'=>true)
            );
        }
}
