<?php

namespace App\Form;

use App\Entity\Button;
use App\Entity\ButtonArticles;
use App\Entity\ImgArticles;
use App\Service\UploaderHelper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ButtonArticlesType extends AbstractType
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
//        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
//            $data = $event->getData();
//            if (!isset($data)) {
//                unset($event);
//                return;
//            }
//            $form = $event->getForm();
//            $form
////                ->add('articles', null, [
////                'required' => false,
////            ])
//                ->add('button', EntityType::class, [
//                    'class' => Button::class,
//                    'choice_label' => 'title',
//                    'attr' => ['class' => 'form-control'],
//                    'required' => false,
//                ])
//                ->add('url', null, [
//                    'attr' => ['class' => 'form-control'],
//                ]);
// });
            $builder->add('button', EntityType::class, [
                'class' => Button::class,
                'choice_label' => 'title',
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
                ->add('url', null, [
                    'attr' => ['class' => 'form-control'],
                ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ButtonArticles::class,
        ]);
    }
}
