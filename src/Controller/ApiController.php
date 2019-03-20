<?php

// C'est quoi un namespace ?
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;


use Swift_Mailer;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



use App\Form\SearchType;


// C'est quoi extends ? Heritage
class ApiController extends AbstractController {


    public function rest(Request $request) {

        $uri= "/gnw/articles?";
        $date= "date=20180701__20180702";
        $edition = "&edition=fr-fr";
        $key = "&key=11116dbf000000000000960d2228e999";
        $limit = "&hard_limit=500";
        $topic = "&topic=s";
        $order = "&order[col]=social_score";
        // https://api.ozae.com/gnw/ngrams?date=20190103__20190109&limit=20&key=11116dbf000000000000960d2228e999&query=brexit&edition=fr-fr&topic=w
        $url= $this->url.$uri.$date.$this->edition."&".$this->key.$limit.$topic;
        $timeout = 10; 
        
        $ch = curl_init($url); 

        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true); 
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 

        if (preg_match('`^https://`i', $url)) 
        { 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
        } 

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

        // Récupération du contenu retourné par la requête 
        $page_content = json_decode(curl_exec($ch), true);

        
        curl_close($ch); 
        return $this->render($page_content);
        
    }

  
}