<?php

namespace App\Form\Type;

use App\Entity\Randonnee;
use App\Repository\RandonneeRepository;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ['required' => true,])
            ->add('email', TextType::class, ['required' => true,])
            ->add('message', TextareaType::class, ['constraints' => [new Length(['min' => 5]), new Length(['max' => 255])]])
            ->add('randonnees', EntityType::class, [
                'required' => true,
                'class' => Randonnee::class,
                'choice_label' => 'titre',
                'multiple' => true,
                'query_builder' => function (RandonneeRepository $randonneeRepository) {
                    return $randonneeRepository->createQueryBuilder('r')
                        ->orderBy('r.date', 'ASC');
                },
            ])
            ->add('save', SubmitType::class);
    }
}
