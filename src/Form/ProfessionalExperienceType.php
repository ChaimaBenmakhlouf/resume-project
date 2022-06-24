<?php

namespace App\Form;

use App\Entity\ProfessionalExperience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfessionalExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class, [
            "label" => "title of the experience :",
            "attr" => [
                "placeholder" => "Enter title of the experience ..."
            ]
        ])
        ->add('startedAt', DateType::class, [
            "label" => "Début de la formation",
            "input" => "datetime_immutable",
            "widget" => "single_text"
        ])
            ->add('startedAt', DateType::class, [
                "label" => "Début de la formation",
                "input" => "datetime_immutable",
                "widget" => "single_text"
            ])
            ->add('endedAt', DateType::class, [
                "label" => "Fin de la formation",
                "input" => "datetime_immutable",
                "widget" => "single_text",
                "required" => false
            ])
            ->add('place', TextType::class, [
                "label" => "place of the diploma :",
                "attr" => [
                    "placeholder" => "Enter the place ..."
                ]
            ])
            ->add('mission_statement', TextareaType::class, [
                "label" => "mission statement :",
                "attr" => [
                    "placeholder" => "Enter the missions ..."
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfessionalExperience::class,
        ]);
    }
}
