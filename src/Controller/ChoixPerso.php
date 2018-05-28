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

class ChoixPerso extends Controller{

    /**
     * @Route("/compte")
     */
    public function choixPerso(Request $request, SessionInterface $session){
        if(!$session->get('user')){
            return $this->redirectToRoute('login');
        }
        //affiche les perso correspondant à l'id compte
        $compte = $this->getDoctrine()
            ->getRepository(Compte::class)
            ->findOneBy(array('pseudo'=>$session->get('user')));

        $perso = $this->getDoctrine()
            ->getRepository(Partie::class)
            ->findAlivePerso($compte->getId());

        //FORMULAIRE
        //
        //affichage des avatar dans le formulaire
        //
        $avatarArray = array();
        $avatar = $this->getDoctrine()
            ->getRepository(Avatar::class)
            ->findAll();

        $compte = $this->getDoctrine()
            ->getRepository(Compte::class)
            ->findOneBy(array('pseudo'=>$session->get('user')));

        foreach($avatar as $i){
            $avatarArray[$i->getImage()] = $i;
        }
        //formulaire pour ajouter un perso
        $partie = new Partie();
        $createPartie = $this->createFormBuilder($partie)
            ->add('nom', TextType::class, array('label'=>"Nom : "))
            ->add('avatar', ChoiceType::class, array('choices'=>$avatarArray, 'label'=>'Avatar : '))
            ->add('save', SubmitType::class, array('label'=>"Ajouter le personnage"))
            ->getForm();
        $partie->setScore(0);
        $partie->setLife(10);
        $partie->setCompte($compte);
        $partie->setOver(false);

        $createPartie->handleRequest($request);
        if($createPartie->isSubmitted() && $createPartie->isValid()){
            $el = $this->getDoctrine()->getManager();
            $el->persist($partie);
            $el->flush();
            return $this->redirectToRoute("choixperso");
        }
        return $this->render('choixperso.html.twig', array(
                'choixperso'=>$createPartie->createView(),
                'perso'=>$perso,
                'compte'=>$session->get('user')
            )
        );
    }
}
