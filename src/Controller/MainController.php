<?php

namespace App\Controller;

use App\Entity\Annonces;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {

        //dd($cat);
        //echo $cat;die();
        //dd($this->getUser());
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/mentions-legales", name="mentions")
     */
    public function mentions()
    {
        return $this->render('main/mentions.html.twig');
    }
}
