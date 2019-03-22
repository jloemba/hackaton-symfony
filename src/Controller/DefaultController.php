<?php

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
     * @Route(name="app_bubble_load", path="/bubble/load/{query}", methods={"GET","POST"})
     */ 
    public function ajaxAction(Request $request, ApiService $api,$query=null) {
        
        //dump($request->get('query'));
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {

            if($request->get('motCle')!=null  && $api->getBulles($request->get('motCle'))){
                $dataPhp = $api->getBulles($request->get('motCle'));
                    
                return new JsonResponse($dataPhp);
            }else{
                dump($request->get('query'));
                $dataPhp = $api->getBulles($request->get('query'));
                return new JsonResponse($dataPhp);
            }
             
        }
    }  


    
    
}
