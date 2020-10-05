<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Form\Type\InscriptionType;
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
     * @Route("/{id}", name="inscription")
     */
    public function new(int $id, Request $request, EntityManagerInterface $entityManager)
    {
        $inscription = new Inscription();
        $form = $this->createForm(InscriptionType::class, $inscription);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $inscription = $form->getData();

            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('randonneeHome');
        }

        return $this->render('inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
