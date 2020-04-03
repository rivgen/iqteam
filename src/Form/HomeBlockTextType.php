<?php

namespace App\Form;

use App\Entity\HomeBlockText;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HomeBlockTextType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('text', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('title', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('icon', null, [
                'attr' => ['class' => 'form-control']
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HomeBlockText::class,
        ]);
    }
}
