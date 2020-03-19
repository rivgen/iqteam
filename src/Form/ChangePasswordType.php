<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 19.03.2020
 * Time: 21:59
 */

namespace App\Form;


use App\Form\Model\RecoverPasswordModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('plainPassword', RepeatedType::class, [
        'type' => PasswordType::class,
//                'mapped' => false,
        'constraints' => [
            new NotBlank([
                'message' => 'Please enter a password',
            ]),
            new Length([
                'min' => 6,
                'minMessage' => 'Your password should be at least {{ limit }} characters',
                // max length allowed by Symfony for security reasons
                'max' => 4096,
            ]),
        ],
        'first_options' => ['label' => 'Password', 'attr' => ['class' => 'form-control']],
        'second_options' => ['label' => 'Repeat Password', 'attr' => ['class' => 'form-control']],
    ])
        ->add('submit', SubmitType::class, [
            'label' => 'поменять пароль'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RecoverPasswordModel::class,
        ]);
    }
}