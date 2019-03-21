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
        
        $page_content = json_decode(curl_exec($ch), true);

        
        curl_close($ch); 
        return $page_content["articles"];
        
    }
    
    public function mostMentionnedSport(){
        $uri= "/gnw/ngrams?";
        $date= "date=20190103__20190109";
        $edition = "&edition=fr-fr";
        $key = "&key=11116dbf000000000000960d2228e999";
        $limit = "&hard_limit=500";
        $topic = "&topic=s";
        $order = "&order[col]=social_score";
        $url= $this->url.$uri.$date.$limit."&".$this->key.$topic;
        
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

        $page_content = json_decode(curl_exec($ch), true);
        
        curl_close($ch); 
        return $page_content["ngrams"]; 
    }
    
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
    
    public function getArticleTexted($mot = '', $date = '20190301__20190320'){
        
        $uri= "/gnw/articles?";
        $date= "date=".$date;
        $edition = "&edition=fr-fr";
        $key = "&key=11116dbf000000000000960d2228e999";
        $limit = "&hard_limit=20";
        $topic = "&topic=s";
        
        if( !empty($mot) ){
            $mot = "&query=".$mot;
        }
        
        $url= $this->url.$uri.$date.$key.$edition.$limit.$topic.$mot;
        
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
        // $this->debug($page_content,true);
        curl_close($ch); 
        return $page_content; 
        
    }
    
    public function getSingleArticle($id_article){
        
        $uri= "/gnw/article/";
        
        $key = "&key=11116dbf000000000000960d2228e999";
        
        $id_article = $id_article.'?';
        
        $url= $this->url.$uri.$id_article.$this->key;
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
    
    public function getBulles($mot = ''){
        
        $articles = $this->getArticleTexted($mot)['articles'];
        
        $i = 1;
        $social_score = 0;
        $tab_ngrams = $tab_unique_ngram = $tab_bulles_info = $tab_bulles = [];
		foreach($articles as $k => $data){
            
            $article = $this->getSingleArticle($data['id']);
            
            $social_score = $social_score + $article['social_score']; // partage
            
            $date_article = $article['date_first_seen']; // durée
            
            if( !empty($article['ngrams']) ){
                foreach($article['ngrams'] as $key => $ng){
                    if( mb_strtolower($ng['ngram']) == mb_strtolower($mot) ){
                        unset($article['ngrams'][$key]);
                    }else{
                        $tab_unique_ngram[] = $ng['ngram'];
                    }
                }
                
                $article['ngrams'] = array_values($article['ngrams']);
                
                $tab_ngrams[] = [
                    'ngrams' => $article['ngrams'],
                    'social_score' => $article['social_score']
                ];

                $i++;
            }
        }
        
        $tab_unique_ngram = array_unique($tab_unique_ngram);
        $tab_unique_ngram = array_values($tab_unique_ngram);
        
        foreach( $tab_unique_ngram as $value ){
            foreach( $tab_ngrams as $ke => $v ){
                foreach( $v['ngrams'] as $ngram_key => $ngram_tab ){
                    if( $value == $ngram_tab['ngram'] ){
                        $tab_bulles_info[$value][] = $v['social_score']; 
                    }
                }
            }
        }
        
        foreach( $tab_bulles_info as $keyinfos => $social_value ){
            
            $sum_score = 0;
            foreach( $social_value as $score ){
                $sum_score = $sum_score + $score;
            }
            
            if( round($sum_score / sizeof($social_value)) > 500 ){
                $tab_bulles[] = [
                    'Name' => $keyinfos,
                    'social_score' => round($sum_score / sizeof($social_value))
                ];
            }
        }

        return $tab_bulles;
    }

    public function getArticles(){


        
    }


    public function debug($param, $die = false){
        
        echo '<pre>' ;
        print_r($param);
        echo '</pre>';
        if( $die == true ){
            die();
        }
    }
    
}