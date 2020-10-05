<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/")
 */
class CategorieController extends AbstractController
{

    /**
     * @Route("/categories", name="categories")
     */
    public function categories(CategorieRepository $categorieRepository)
    {
        $categories = $categorieRepository->findAll();
        return $this->render('categorie.html.twig', [
            'categories' => $categories,
        ]);
    }
}
