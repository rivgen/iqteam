<?php

namespace App\Form;

use App\Entity\Articles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\Image;

class ArticlesType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null,[
                'attr' => ['class' => 'form-control']
            ])
            ->add('fullTitle', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('textPreview', TextareaType::class,[
                'attr' => ['class' => 'form-control']
             ])
            ->add('technology', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('client', null, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('year', null, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('alias', null, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
//            ->add('created')
//            ->add('updated')
            ->add('author', null,[
                'data' => $this->security->getUser()->getFirstName(),
                'attr' => ['class' => 'form-control']
            ])
            ->add('iconFile', FileType::class, [
                'label' => 'Загрузить иконку',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '2M'
                    ])
                ],
//                'attr' => ['class' => 'form-control']
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Загрузить картинку',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '5M'
                    ])
                ],
            ])
//            ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}