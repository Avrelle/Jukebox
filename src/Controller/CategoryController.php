<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\MusicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $category, MusicRepository $music): Response
    {
        $categories = $category->findall();
        $song = $music->findAll();


        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories,
            'song' => $song
        ]);
    }
}