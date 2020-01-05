<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use App\Repository\RoleRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class UserType extends AbstractType
{
    private $roleRepository;
    private $security;

    public function __construct(RoleRepository $roleRepository, Security $security)
    {
        $this->roleRepository = $roleRepository;
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $role = "ROLE_SUPER_ADMIN";
//        dump($this->security->getUser());
        if ($this->security->isGranted("ROLE_SUPER_ADMIN")){
            $role = '';
        }
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class,[
                'choices' => $this->roleRepository->getNameRole($role),
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
