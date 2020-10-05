<?php

namespace App\Controller;

use App\Repository\RandonneeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/randonnee")
 */
class RandonneeController extends AbstractController
{

    /**
     * @Route("/", name="randonneeHome")
     */
    public function home(RandonneeRepository $randonneeRepository)
    {
        $randonnees = $randonneeRepository->findMostRecent();
        return $this->render('home.html.twig', [
            'randonnees' => $randonnees,
        ]);
    }

    /**
     * @Route("/categories/{id}", name="randonnesParCategorie")
    */
    public function randonnesParCategorie(int $id, RandonneeRepository $randonneeRepository)
    {
        $randonnees = $randonneeRepository->findRandonneeByCategorie($id);
        return $this->render('randonnee/list.html.twig', [
            'randonnees' => $randonnees,
        ]);
    }


    /**
     * @Route("/countRandonnee", name="countRandonnee")
     */
    public function countRandonnee(RandonneeRepository $randonneeRepository)
    {
        $number = $randonneeRepository->countAll();
        return $this->render('_footer.html.twig', [
            'number' => $number[0],
        ]);
    }

    /**
     * @Route("/{id}", name="randonneeDetail")
     */
    public function detail(int $id, RandonneeRepository $randonneeRepository)
    {
        $randonnee = $randonneeRepository->findById($id);
        return $this->render('randonnee/detail.html.twig', [
            'randonnee' => $randonnee,
        ]);
    }
}
