<?php

namespace App\Controller;
use App\Entity\Partie;
use App\Entity\Compte;
use App\Entity\Avatar;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Jeu extends Controller{

    /**
     * @Route("/jeu")
     */
    public function jeu(Request $request, SessionInterface $session){
        if(!$session->get('user'))
        {
            return $this->redirectToRoute('login');
        }
        //check si le perso appartient bien au compte de la session
        $comptePerso = $this->getDoctrine()
            ->getRepository(Partie::class)
            ->findCompteByPersoId($request->get('perso'));
        if(!$comptePerso or $comptePerso['pseudo'] != $session->get('user')){
            return $this->redirectToRoute('choixperso');
        }
        $comptePerso = $this->getDoctrine()
            ->getRepository(Partie::class)
            ->findPersoById($request->get('perso'));
        //check si le perso est vivant
        if($comptePerso['over'] === '1'){
            return $this->redirectToRoute('gameover');
        }
        //
        //Jeu
        //
        return $this->render('jeu.html.twig',
            array('perso'=>$comptePerso, 'debug'=>$request->get("debug")));
    }

    /**
     * @Route("/jeu/{id}/get")
     */
    public function jeuGet(Request $request, SessionInterface $session, $id){
        //if(!$session->get('user'))
        //{
        //    return new Response("erreur la session n'existe pas !");
        //}
        //check si le perso appartient bien au compte de la session
        //TODO : ne fonctionne pas avec avec xmlhttprequest !
        //$comptePerso = $this->getDoctrine()
        //    ->getRepository(Partie::class)
        //    ->findCompteByPersoId($request->get('perso'));
        //if(!$comptePerso or $comptePerso['pseudo'] != $session->get('user')){
        //    return new Response("le perso ".$id." ne correspond pas à la session !");
        //}
        $comptePerso = $this->getDoctrine()
            ->getRepository(Partie::class)
            ->findPersoById($id);
        //check si le perso est vivant
        if($comptePerso['over'] === '1'){
            return new Response("erreur le personnage est mort !");
        }
        return new Response(json_encode($comptePerso));
    }

    /**
     * @Route("/jeu/{id}/save/{life}/{score}")
     */
    public function jeuSave(Request $request, SessionInterface $session, $id, $life, $score){
        if(!$session->get('user'))
        {
            return $this->redirectToRoute('login');
        }
        //check si le perso appartient bien au compte de la session
        //$comptePerso = $this->getDoctrine()
        //    ->getRepository(Partie::class)
        //    ->findCompteByPersoId($request->get('perso'));
        //if(!$comptePerso or $comptePerso['pseudo'] != $session->get('user')){
        //    return $this->redirectToRoute('choixperso');
        //}
        $comptePerso = $this->getDoctrine()
            ->getRepository(Partie::class)
            ->findPersoById($id);
        //check si le perso est vivant
        if((int)$comptePerso['life'] <= 0)
        {
            $this->getDoctrine()
            ->getRepository(Partie::class)
            ->diePerso($id);
            return $this->redirectToRoute('gameover');
        }
        if($comptePerso['over'] === '1'){
            return $this->redirectToRoute('gameover');
        }

        $this->getDoctrine()
        ->getRepository(Partie::class)
        ->changeLifeScorePerso($id,$life,$score);
        return new Response("saved !");
    }

    /**
     * @Route("/jeu/{id}/die")
     */
    public function jeuDie(Request $request, SessionInterface $session, $id){
        if(!$session->get('user'))
        {
            return $this->redirectToRoute('login');
        }
        $comptePerso = $this->getDoctrine()
            ->getRepository(Partie::class)
            ->findPersoById($id);
        //check si le perso a bien 0 pv ou moins
        if((int)$comptePerso['life'] <= 0)
        {
            $this->getDoctrine()
            ->getRepository(Partie::class)
            ->diePerso($id);
            return $this->redirectToRoute('gameover');
        }
        else{
            return new Response ("le perso n'est pas mort !");
        }
    }

}
