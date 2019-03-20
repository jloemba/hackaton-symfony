<?php

// C'est quoi un namespace ?
namespace App\Controller;

// Inclusion d'une librarie
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Swift_Mailer;

use App\Form\ContactAdminType;


use Symfony\Component\HttpFoundation\Request;


/*
 * @Route
 */


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
class DefaultController extends AbstractController {
    /**
     * @Route(name="app_default_index", path="/", methods={"GET"})
     * @return Response
     */
    public function index(Request $request) {


        return $this->render('views/home.html.twig');
        
    }

  
}