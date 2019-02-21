<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurFrontController extends AbstractController
{
    /**
     * @Route("/", name="connexion")
     * 
     */
    public function connection (\App\Repository\UtilisateurRepository $rep, \Symfony\Component\HttpFoundation\Request $req) {
        $dto = new \App\Entity\Utilisateur();
        $form = $this->createForm(\App\Form\ConnectionType::class, $dto);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) { //POST
            $qb = $rep->createQueryBuilder("u")
                    ->andWhere("u.nom=:USER")
                    ->setParameter("USER", $dto->getUser())
                    ->andWhere("u.email=:MAIL")
                    ->setParameter("MAIL", $dto->getEmail())
                    ->andWhere("u.mdp=:PSW")
                    ->setParameter("PSW", $dto->getPassword());
                    
            $util = $qb->getQuery()->getSingleResult(); //getSingleResult declenche une exception
            //Util est trouvé en base

            $req->getSession()->set("utilUser", $util->getUser()); // apres ceci on est connecté
            //ici on redirige vers la liste des recettes
            return $this->redirectToRoute("home");
        }
        //GET
        //ON VEUT Afficher la page de connxeion

        return $this->render("utilisateur_front/connection.html.twig", ["monForm" => $form->createView()]);
    }
    
    /**
     * 
     * @Route("/inscription", name="inscription")
     */
    public function inscription(\Symfony\Component\HttpFoundation\Request $req) {

        $dto = new \App\DTO\InscriptionDTO();
        $form = $this->createForm(\App\Form\InscriptionType::class, $dto);

        $form->handleRequest($req);


        if ($form->isSubmitted() && $form->isValid()) {
            $util = new \App\Entity\Utilisateur(); //jinstancie utilisateur
            $util->setUser($dto->getUser());
            $util->setPassword($dto->getPassword());
            $util->setEmail($dto->getEmail());
            $util->setRole('User');
            $em = $this->getDoctrine()->getManager();
            $em->persist($util);
            $em->flush();

            return $this->redirectToRoute("connection");
        }

        return $this->render("utilisateur_front/inscription.html.twig", ["monForm" => $form->createView()]);
    }
    
   
    
}
