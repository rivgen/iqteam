<?php

namespace App\Form;

use App\Entity\ImgArticles;
use App\Service\UploaderHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
            $data = $event->getData();
            if (!isset($data)) {
                unset($event);
                return;
            }
            $form = $event->getForm();
            $form->add('general', HiddenType::class, [
                    'required' => false,
            ])
                ->add('img', HiddenType::class, [
                    'required' => false,
                ]);
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ImgArticles::class,
        ]);
    }
}
