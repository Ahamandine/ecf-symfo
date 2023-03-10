<?php

namespace App\Controller;

use App\Entity\Emprunteur;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DbTestUserController extends AbstractController
{
    #[Route('/db/test/user', name: 'app_db_test_user')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $userRepository = $doctrine->getRepository(User::class);
        $emprunteurRepository = $doctrine->getRepository(Emprunteur::class);

        // - la liste complète de tous les utilisateurs (de la table 'user')
        $users = $userRepository->findAll();
        dump($users);

        // les données de l'utilisateur dont l'id est 1
        $user = $userRepository->find(1);
        dump($user);

        // les données de l'utilisateur dont l'email est 'foo.foo@example.com'
        $user = $userRepository->findOneBy([
            'email' => 'foo.foo@example.com'
        ]);
        dump($user);

        // les déonnées des utilisateurs dont l'attribut 'roles' contient le mot clé 'ROLE_EMPRUNTEUR'
        $users= $userRepository->findByRoleEmprunteur();
        dump($users);

        // les données du profile emprunteur de l'utilisateur dont l'id est '2'
        $user = $userRepository->find(2);
        $emprunteur = $emprunteurRepository->findByUser($user);
        dump($emprunteur);

        //ne pas faire comme ça, c'est un simple test
        exit();
    }
}
