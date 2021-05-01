<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\AnnoncesType;
use App\Form\EditProfileType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
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


    /**
     * @Route("/profil/modifier", name="profil_modifier")
     */
    public function editProfile(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('users_home');
        }

        return $this->render('users/editprofile.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/pass/modifier", name="pass_modifier")
     */
    public function editPass(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if($request->isMethod('POST')){
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();

            //dd($request->request);

            // On vérifie si les 2 mots de passe sont identiques
            if($request->request->get('pass') == $request->request->get('pass2')){
                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('pass')));
                $em->flush();
                $this->addFlash('message', 'Mot de passe mis à jour avec succès');

                return $this->redirectToRoute('users_home');
            }else{
                $this->addFlash('error', 'Les deux mots de passe ne sont pas identiques');
            }
        }

        return $this->render('users/editpass.html.twig');
    }

}
