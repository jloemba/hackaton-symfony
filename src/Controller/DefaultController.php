<?php

// C'est quoi un namespace ?
namespace App\Controller;

// Inclusion d'une librarie
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        

        // $api->debug(($api->getBulles ('psg')),true);

        if($api){
            $data = $api->mostMentionnedSport();        
            return $this->render(
                'views/home.html.twig',
                array('data' => $data)
            );
        }else{
            return $this->render(
                'views/home.html.twig',
                array('data' => "Bruh")
            );
        }        
    }

    /** 
     * @Route("/bubble/load")
     */ 
    public function ajaxAction(Request $request, ApiService $api) {
        
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            
            $dataPhp = $api->getBulles($_POST['motCle']);
                    
            return new JsonResponse($dataPhp); 
        }
    }  
    
}