<?php
// your-path-to-types/ContactType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                    'attr' => [
//                        'placeholder' => 'Ваше имя',
                        'class' => 'form-control'],
                    'label' => 'Ваше имя',
                    'constraints' => [
                        new NotBlank(["message" => "Пожалуйста, укажите ваше имя"])
                    ],
                ]
            )
            ->add('email', EmailType::class, [
                'attr' => [
//                    'placeholder' => 'Ваш email',
                    'class' => 'form-control'],
                'label' => 'e-mail',
                'constraints' => [
                    new NotBlank(["message" => "Пожалуйста, предоставьте действительный адрес электронной почты"]),
                    new Email(["message" => "Ваш адрес электронной почты не является действительным"]),
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
//                    'placeholder' => 'Ваше сообщение',
                    'class' => 'form-control'],
                'label' => 'сообщение',
                'constraints' => [
                    new NotBlank(["message" => "Пожалуйста, оставьте сообщение здесь"]),
                ]
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