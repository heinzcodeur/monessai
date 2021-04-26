<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\AnnoncesType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/users", name="users_")
 * @package App\Controller
 */
class UsersController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
    }

    /**
     * @Route("/", name="home")
     * @package App\Controller
     */
    public function index(): Response
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    /**
     * @Route("/annonces/ajout", name="annonces_ajout")
     */
    public function ajoutAnnonce(Request $request, EntityManager $manager){

        $annonce = new Annonces;

        $form = $this->createForm(AnnoncesType::class, $annonce);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $annonce->setUsers($this->getUser());
            //$annonce->setUsers($this->security->getUser());
            $annonce->setActive(false);

            $em = $this->getDoctrine()->getManager();
            //$manager->persist($annonce);
            $em->persist($annonce);
            //dd($annonce);
            $em->flush();

            return $this->redirectToRoute(('users_home'));
        }

        return $this->render('users/annonces/ajout.html.twig', [
           'form' => $form->createView()
        ]);

    }
}
