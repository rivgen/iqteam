<?php

namespace App\Form;

use App\Entity\Articles;
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
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ButtonArticlesType extends AbstractType
{

    private $uploaderHelper;
    protected $requestStack;

//    private $filter = "";

    public function __construct(UploaderHelper $uploaderHelper, RequestStack $requestStack)
    {

        $this->uploaderHelper = $uploaderHelper;
        $this->requestStack = $requestStack;
//        $this->filter = $filter;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
//            $data = $event->getData();
//            dump($data);
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
//        $id = $options['data']->getId();
        $request = $this->requestStack->getCurrentRequest();
        $id = $request->attributes->get('id');
//        dump($id);
        $builder
                ->add('button', EntityType::class, [
                'class' => Button::class,
                'choice_label' => 'title',
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
                ->add('articles', EntityType::class, [
                    'class' => Articles::class,
                    'choice_label' => 'id',
//                    'attr' => ['class' => 'form-control'],
//                    'data' => $id,
                    'empty_data' => $id,
                    'required' => false,
                ])
                ->add('url', null, [
                    'attr' => ['class' => 'form-control'],
//                    'required' => false,
                ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ButtonArticles::class,
        ]);
    }
}
