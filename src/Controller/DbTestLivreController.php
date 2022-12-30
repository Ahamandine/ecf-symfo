<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Livre;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DbTestLivreController extends AbstractController
{
    #[Route('/db/test/livre', name: 'app_db_test_livre')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $livreRepository = $doctrine->getRepository(Livre::class);
        $auteurRepository = $doctrine->getRepository(Auteur::class);

        // la liste des livres dont le titre contient le mot 'lorem'
        $livres = $livreRepository->findByTitre('lorem');
        dump($livres);
        
        // liste des livres dont l'id de l'auteur est '1'
        $auteur = $auteurRepository->find(1);
        $livres = $livreRepository->findByAuteur($auteur);
        dump($livres);

        // liste des livrse dont le genre contient le mot clef 'roman'
        $livres = $livreRepository->findByNomGenre('roman');

        // Boucle pour récupérer les genres associés aux livres
        foreach($livres as $livre){
            dump($livre->getTitre());
            
            foreach ($livre->getGenres() as $genre){

                dump($genre->getNom());
            }
        }

        exit();
    }
}
