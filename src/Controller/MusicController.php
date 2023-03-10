<?php

namespace App\Controller;

use App\Entity\Music;
use App\Repository\MusicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted; 
use Doctrine\ORM\EntityManagerInterface;

class MusicController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/', name: 'app_music')]
    public function index(MusicRepository $song): Response
    {
        $musics = $song->findAll();


        return $this->render('music/index.html.twig', [
            'controller_name' => 'MusicController',
            'musics' => $musics,
        ]);
    }
    #[Route('/favoris/add/{id}', name: 'add_favoris')]
    public function addFavoris(Music $music, EntityManagerInterface $entityManager)
    {
        
        $music->addFavori($this->getUser());

       
        $entityManager->persist($music);
        $entityManager->flush();

        return $this->redirectToRoute('app_login');
    }

    #[Route('/favoris/remove/{id}', name: 'remove_favoris')]
    public function removeFavoris(Music $music)
    {
        
        $music->removeFavori($this->getUser());

        $em = $this->getDoctrine()->getManager();
        $em->persist($music);
        $em->flush();
 
        return $this->redirectToRoute('app_login');
    }
}
?>