<?php

namespace App\Form;

use App\Entity\ImgArticles;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImgArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $img = $event->getData()->getImg();
            $id = $event->getData()->getArticle()->getId();
            $form = $event->getForm();
//            dump( $event->getData()->getArticle()->getId());
//            $form->add('img', null, [
//                'help' => "<img src='/media/cache/squared_thumbnail_small/images/articles/$id/$img' height='100'/>",
//                'help_html' => true
//            ]);
            $form->add('general'
                , ChoiceType::class, [
                    'choices' => [
                        'yes' => true,
                        'no' => false,
                    ],
                    'help' => "<img src='/media/cache/squared_thumbnail_small/images/articles/$id/$img' height='100'/>",
                    'help_html' => true,
                    'required' => false,
                    'by_reference' => false,
                    'expanded' => true,
                    'multiple' => false,
                    'label' => false,
                    'attr' => ['class' => 'radio']
                ]
            );
        });
//        $builder
//            ->add('general'
//                , ChoiceType::class, [
//                    'choices' => [
//                        'yes' => true,
//                        'no' => false,
//                    ],
////                    'class' => ImgArticles::class,
////
////                    'choice_label' => 'general',
//                    'required' => false,
//                    'by_reference' => false,
//                    'expanded' => true,
//                    'multiple' => false
//                ]
//            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ImgArticles::class,
        ]);
    }
}
