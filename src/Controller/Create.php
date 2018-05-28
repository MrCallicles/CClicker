<?php
namespace App\Controller;

use App\Entity\Compte;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Create extends Controller{
    /**
     * @Route("/create")
     */
    public function create(Request $request, SessionInterface $session){
        if($session->get("user")){
            return $this->redirectToRoute("choixperso");
        }
        $validPseudo=true;
        $compte = new Compte();
        $create = $this->createFormBuilder($compte)
            ->add('pseudo', TextType::class)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => "Créer un compte" ))
            ->getForm();

        //check si de pseudo n'est pas déjà dans la base
        $create->handleRequest($request);
        if($create->isSubmitted() && $create->isValid()){
            $createFormData = $create->getData();
            $check = $this
                ->getDoctrine()
                ->getRepository(Compte::class)
                ->findAll();

            foreach($check as $i){
                if($i->getPseudo() ===  $createFormData->getPseudo()){
                    $validPseudo=false;
                }
            }
            if($validPseudo === true){
                $el = $this->getDoctrine()->getManager();
                $el->persist($compte);
                $el->flush();
                $session->set('user', $createFormData->getPseudo());
                return $this->redirectToRoute("choixperso");
            }
            if($validPseudo === false)
            {
            return $this->render('create.html.twig', array(
                    'create' => $create->createView(),
                    'validPseudo'=>false));
            }
        }
        return $this->render('create.html.twig', array(
                'create' => $create->createView(),
                'validPseudo'=>true));
    }

}
