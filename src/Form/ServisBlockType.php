<?php

namespace App\Form;

use App\Entity\ServisBlok;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServisBlockType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('text', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Text',
                'required' => false,
            ])

            ->add('textEn', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Text язык(en)',
                'required' => false,
            ])
            ->add('title', TextType::class, [
                'label' => 'Title',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    ],
            ])
            ->add('titleEn', TextType::class, [
                'label' => 'Title язык(en)',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    ],
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ServisBlok::class,
        ]);
    }
}
