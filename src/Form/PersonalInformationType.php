<?php

namespace App\Form;

use App\Entity\PersonalInformation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonalInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname', TextType::class, [
            "label" => "firstname :",
            "attr" => [
                "placeholder" => "Enter the firstname ..."
            ]
            ])
        ->add('lastname', TextType::class, [
            "label" => "lastname :",
            "attr" => [
                "placeholder" => "Enter the lastname ..."
            ]
            ])
       
        ->add('address', TextType::class, [
            "label" => "address :",
            "attr" => [
                "placeholder" => "Enter the address ..."
            ]
            ])
        ->add('phone_number', TextType::class, [
            "label" => "phone number :",
            "attr" => [
                "placeholder" => "Enter the phone number ..."
            ]
            ])
        ->add('linkedin_link', TextType::class, [
            "label" => "linkedin link :",
            "attr" => [
                "placeholder" => "Enter the linkedin link ..."
            ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonalInformation::class,
        ]);
    }
}
