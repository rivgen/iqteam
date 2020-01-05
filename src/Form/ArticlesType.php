<?php

namespace App\Form;

use App\Entity\Articles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

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
            ->add('title')
            ->add('fullTitle', TextareaType::class)
            ->add('textPreview', TextareaType::class,[
                'attr' => ['class' => 'textPreviewForm']
             ])
            ->add('technology', TextareaType::class)
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'textPreviewForm']
            ])
            ->add('client')
            ->add('year')
            ->add('alias')
//            ->add('created')
//            ->add('updated')
            ->add('author', null,[
                'data' => $this->security->getUser()->getFirstName()
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
