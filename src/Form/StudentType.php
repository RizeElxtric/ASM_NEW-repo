<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class,
        [
            'label' => 'Student Name',
            'attr' => [
                'minlength' => 3,
                'maxlength' => 30
            ]
        ])
        ->add('phone', IntegerType::class,
        [
            'label' => 'Phone number'
        ])
        ->add('email', TextType::class,
        [
            'label' => 'Email',
            'minlength' => 3,
            'maxlength' => 40
        ])
        ->add('date', DateType::class,
        [
            'label' => 'Published date',
            'widget' => 'single_text'
        ])
        ->add('image' ,TextType::class,
        [
            'label' => 'Book image',
            'attr' => [
                'maxlength' => 255
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}