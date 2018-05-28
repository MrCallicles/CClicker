<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Partie;

class HighScore extends Controller{
    /**
     * @Route("/highscore")
     */
    public function highScore(){
        $nb = 10;
        $highscore = $this->getDoctrine()->getRepository(Partie::class)->getHighScore($nb);
        return $this->render(
            'highscore.html.twig',
            array("high"=>$highscore)
        );
    }

    /**
     * @Route("/highscore.json")
     */
    public function highScoreJson(){
        $nb = 10;
        $highscore = $this->getDoctrine()
            ->getRepository(Partie::class)
            ->getHighScore($nb);
        return new Response(json_encode($highscore));
    }
}
