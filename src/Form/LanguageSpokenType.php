<?php

namespace App\Form;

use App\Entity\LanguageSpoken;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LanguageSpokenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            "label" => "Name of the language :",
            "attr" => [
                "placeholder" => "Enter the language..."
            ]
        ])
        ->add('level', ChoiceType::class, [
            "label" => "Your level :",
            "choices" => [
                "A1" => "A1",
                "A2" => "A2",
                "B1" => "B1",
                "B2" => "B2",
                "C1" => "C1",
                "C2" => "C2",
                
            ]
                ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LanguageSpoken::class,
        ]);
    }
}
