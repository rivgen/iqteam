<?php
// your-path-to-types/ContactType.php

namespace App\Form;

use App\Entity\Subscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class SubscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control footerForm',
                    'placeholder' => 'footerForm.placeholder',],
                'label' => 'e-mail',
                'constraints' => [
                    new NotBlank(["message" => "contactForm.constraints.message.validEmail"]),
                    new Email(["message" => "contactForm.constraints.message.validEmail2"]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Subscription::class,
            'invalid_message' => 'Error!',
            'translation_domain' => 'messages'
        ]);
    }
}