<?php

// C'est quoi un namespace ?
namespace App\Controller;

// Inclusion d'une librarie
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Swift_Mailer;

use App\Form\ContactAdminType;

use App\Service\ApiService;

use Symfony\Component\HttpFoundation\Request;


/*
 * @Route
 */

// C'est quoi extends ? Heritage
class DefaultController extends AbstractController {

    //Modifier cette route pour avoir les ngrams du topics 'sport' par défaut
    /**
     * @Route(name="app_default_index", path="/", methods={"GET"})
     */
    public function index(ApiService $api) {
        

        $api->debug(($api->getBulles ('psg')),true);

        if($api){
            $data = $api->mostMentionnedSport();        
            return $this->render(
                'hello.html.twig',
                array('data' => $data)
            );
        }else{
            return $this->render(
                'hello.html.twig',
                array('data' => "Bruh")
            );
        }        
    }
    
}