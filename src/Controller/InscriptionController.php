<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Form\Type\InscriptionType;
use App\Repository\RandonneeRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/inscription")
 */
class InscriptionController extends AbstractController
{

    /**
     * @Route("/valid", name="inscriptionValid")
     */
    public function valid()
    {
        return $this->render('inscription/valid.html.twig');
    }

    /**
     * @Route("/{id}", name="inscriptionNew")
     */
    public function new(int $id, Request $request, EntityManagerInterface $entityManager, RandonneeRepository $randonneeRepository)
    {
        $inscription = new Inscription();
        $randonnee = $randonneeRepository->findById($id);
        $form = $this->createForm(InscriptionType::class, $inscription, array("randonnee" => $randonnee));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $inscription = $form->getData();
            $inscription->setDate(new DateTime());

            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('inscriptionValid');
        }

        return $this->render('inscription/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
