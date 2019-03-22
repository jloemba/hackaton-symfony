<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Swift_Mailer;

use App\Form\ContactAdminType;

use App\Service\ApiService;

use Symfony\Component\HttpFoundation\Request;


/*
 * @Route
 */

class DebugService {

    public function __construct(){

    }


    public function check($param, $die = false){
        
        echo '<pre>' ;
        print_r($param);
        echo '</pre>';
        if( $die == true ){
            die();
        }
    }
    
}