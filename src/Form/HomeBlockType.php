<?php

namespace App\Form;

use App\Entity\HomeBlock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class HomeBlockType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('titleRu', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Title RU',
                'required' => false,
//                'constraints' => [
//                    new NotBlank(["message" => "Пожалуйста, укажите имя"])
//                ],
            ])
            ->add('titleEn', TextType::class, [
                'label' => 'Title EN',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    ],
            ])
            ->add('homeBlockText', CollectionType::class, [
                'entry_type' => HomeBlockTextType::class,
                'label' => 'Текстовые блоки',
//                'allow_delete' => true,
//                'by_reference' => false,
//                'empty_data' => false,
//                'delete_empty' => true,
                'allow_add' => true,
//                'required' => false,
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HomeBlock::class,
//            'translation_domain' => 'messages'
        ]);
    }
}
