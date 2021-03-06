<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\ArticlesCategory;
use App\Entity\ImgArticles;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
//        dump($options['data']->getImgArticles());
//        $id = $options['data']->getId();

        $builder
            ->add('title', null, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('titleEn', null, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('fullTitle', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'не более 255 символов'
                    ],
                'required' => false,
            ])
            ->add('fullTitleEn', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'не более 255 символов'
                    ],
                'required' => false,
            ])
            ->add('textPreview', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('textPreviewEn', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('technology', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('technologyEn', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('descriptionEn', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('client', null, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('clientEn', null, [
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
            ->add('metaTitle', null, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'не более 80 символов'
                ],
                'required' => false,
            ])
            ->add('metaTitleEn', null, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'не более 80 символов'
                ],
                'required' => false,
            ])
            ->add('metaDescription', null, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'не более 180 символов'
                ],
                'required' => false,
            ])
            ->add('metaDescriptionEn', null, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'не более 180 символов'
                ],
                'required' => false,
            ])
//            ->add('created')
//            ->add('updated')
            ->add('author', null, [
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
                'attr' => ['class' => 'inputfile', 'data-multiple-caption' => '{count} files selected']
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
            ->add('imgArticles', CollectionType::class, [
                'entry_type' => ImgArticlesType::class,
                'allow_delete' => true,
//                'by_reference' => false,
//                'empty_data' => false,
                'delete_empty' => true,
                'allow_add' => true,
//                'required' => false,
            ])
            ->add('buttonArticles', CollectionType::class, [
                'entry_type' => ButtonArticlesType::class,
                'allow_delete' => true,
//                'by_reference' => false,
//                'empty_data' => false,
                'delete_empty' => true,
                'allow_add' => true,
//                'entry_options' => ['label' => false],
//                'required' => false,
            ])
            ->add('category', EntityType::class, [
                'class' => ArticlesCategory::class,
                'choice_label' => 'title',
                'attr' => ['class' => 'form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
