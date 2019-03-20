<?php

namespace App\Service;

// Inclusion d'une librarie
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
class ApiService {

    private $url = "https://api.ozae.com";
    private $key = "key=11116dbf000000000000960d2228e999";
    private $edition = "&edition=fr-fr";
    private $topic = "&topic=s";

    public function __construct(){

    }

    public function getArticlesSport() {
        $uri= "/gnw/articles?";
        $date= "date=20180701__20180702";
        $limit = "&hard_limit=500";
        $topic = "&topic=s";
        //$order = "&order[col]=social_score";
        $url= $this->url.$uri.$date.$this->edition."&".$this->key.$limit.$this->topic;
        
        $ch = curl_init($url); 
        $timeout =10;
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
        return $page_content["articles"];
        
    }

     // Les mots-clés les plus mentionnés dans le sport
     public function mostMentionnedSport(){
        $uri= "/gnw/ngrams?";
        $date= "date=20190103__20190109";
        $edition = "&edition=fr-fr";
        $key = "&key=11116dbf000000000000960d2228e999";
        $limit = "&hard_limit=500";
        $topic = "&topic=s";
        $order = "&order[col]=social_score";
        $url= $this->url.$uri.$date.$limit."&".$this->key.$topic;
        //var_dump($url);
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
        return $page_content["ngrams"]; 
    }

     // Les articles obtenus suite à une recherche
     public function getArticlesByQuery(){

        $uri= "/gnw/articles?";
        $date= "date=20190103__20190109";
        $limit = "&hard_limit=50";
        $query = "&query=psg";

        $url= $this->url.$uri.$date."&".$this->key.$this->edition.$query.$limit;
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
        return $page_content; 

    }

  
}