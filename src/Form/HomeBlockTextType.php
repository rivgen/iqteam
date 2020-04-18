<?php

namespace App\Form;

use App\Entity\HomeBlockText;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HomeBlockTextType extends AbstractType
{

    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {

        $this->requestStack = $requestStack;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $request = $this->requestStack->getCurrentRequest();
            $id = $request->attributes->get('id');
            $data = $event->getData();
            $form = $event->getForm();
            if (!$data) {
                return;
            }
//            dump($data);
            $checkmark = $data->getCheckmark();
            $icon = $data->getIcon();
            $form
                ->add('text', TextareaType::class, [
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'help_html' => true,
                    'help' => '<img src="' . $icon . '" alt="">',
                ])
                ->add('textEn', TextareaType::class, [
                    'attr' => ['class' => 'form-control'],
                    'required' => false,
                    'label' => 'Text язык(EN)',
                ]);
            if (!in_array($id, [1, 2, 5]) and $checkmark != 'main') {
//
                $form
                    ->add('title', null, [
                        'attr' => ['class' => 'form-control'],
                        'required' => false,
                    ])
                    ->add('titleEn', null, [
                        'attr' => ['class' => 'form-control'],
                        'required' => false,
                        'label' => 'Title язык(EN)',
                    ]);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HomeBlockText::class,
        ]);
    }
}
