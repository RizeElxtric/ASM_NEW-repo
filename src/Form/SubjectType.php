<?php

namespace App\Form;

use App\Entity\Subject;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SubjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class,
        [
            'label' => 'Subject Name',
            'attr' => [
                'minlength' => 3,
                'maxlength' => 30
            ]
        ])
        ->add('info', TextType::class,
        [
            'label' => 'Description',
            'attr' => [
                'minlength' => 1,
                'maxlength' => 100
            ]
        ])
        ->add('fee', MoneyType::class,
        [
            'label' => 'Cost',
            'currency' => 'USD'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subject::class,
        ]);
    }
}