<?php

namespace App\Form;

use App\Entity\MetaTags;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MetaTagsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'не более 80 символов'
                ],
                'required' => false,
            ])
            ->add('titleEn', null, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'не более 80 символов'
                ],
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'не более 180 символов'
                ],
                'required' => false,
            ])
            ->add('descriptionEn', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'не более 180 символов'
                ],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MetaTags::class,
        ]);
    }
}
