<?php

namespace App\Form;

use App\Entity\Diploma;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiplomaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class, [
            "label" => "title of the diploma :",
            "attr" => [
                "placeholder" => "Enter the diploma ..."
            ]
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
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Diploma::class,
        ]);
    }
}
