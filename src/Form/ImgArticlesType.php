<?php

namespace App\Form;

use App\Entity\ImgArticles;
use App\Service\UploaderHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImgArticlesType extends AbstractType
{

    private $uploaderHelper;
//    private $filter = "";

    public function __construct(UploaderHelper $uploaderHelper)
    {

        $this->uploaderHelper = $uploaderHelper;
//        $this->filter = $filter;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $img = $event->getData()->getImg();
            $id = $event->getData()->getArticle()->getId();
            $form = $event->getForm();
            $url = $this->uploaderHelper->getPublicPath($id, $img);
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
                    'help' => "<img src='/media/cache/squared_thumbnail_small$url' height='100'/>",
                    'help_html' => true,
//                    'required' => false,
//                    'empty_data' => null,
                    'by_reference' => false,
                    'expanded' => true,
//                    'multiple' => true,
                    'label' => false,
//                    'choice_label' => false,
                    'attr' => ['class' => 'radio']
                ]
            );
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ImgArticles::class,
        ]);
    }
}
