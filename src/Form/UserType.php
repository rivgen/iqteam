<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class UserType extends AbstractType
{
    private $security;
    private $allRoles = ["ROLE_CONTENT_MANAGER", "ROLE_USER"];

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        dump($this->security->getUser());
        if ($this->security->isGranted("ROLE_SUPER_ADMIN")){
            $role = 'ROLE_SUPER_ADMIN';
            array_unshift ($this->allRoles, $role);
        }
        foreach ($this->allRoles as $out) {
            $allRole[$out] = $out;
        }
//        dump($allRole);
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class,[
                'choices' => [$allRole],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('plainPassword', HiddenType::class,[
                'data' => true
            ])
//            ->add('password')
//            ->add('apiToken')
            ->add('firstName')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
