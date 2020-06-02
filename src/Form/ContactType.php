<?php
// your-path-to-types/ContactType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                    'attr' => [
                        'placeholder' => 'Имя',
                        'class' => 'form-control'],
                    'label' => 'Ваше имя',
                    'constraints' => [
                        new NotBlank(["message" => "Пожалуйста, укажите ваше имя"])
                    ],
                ]
            )
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'e-mail',
                    'class' => 'form-control'],
                'label' => 'e-mail',
                'constraints' => [
                    new NotBlank(["message" => "Пожалуйста, предоставьте действительный адрес электронной почты"]),
                    new Email(["message" => "Ваш адрес электронной почты не является действительным"]),
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Сообщение',
                    'class' => 'form-control'],
                'label' => 'сообщение',
                'constraints' => [
                    new NotBlank(["message" => "Пожалуйста, оставьте сообщение здесь"]),
                ]
            ])
            ->add('file', FileType::class, [
                'label' => '+ Прикрепить фаил',
                'mapped' => false,
                'required' => false,
                'multiple' => true,
//                'constraints' => [
//                    new Image([
//                        'maxSize' => '2M'
//                    ])
//                ],

                'attr' => ['class' => 'inputfile', 'data-multiple-caption' => '{count} files selected']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'invalid_message' => 'Error!',
            'translation_domain' => 'messages'
        ]);
    }

    public function getName()
    {
        return 'contact_form';
    }
}