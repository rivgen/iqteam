<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Button;
use App\Entity\Docks;
use App\Service\UploaderHelper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class DocksType extends AbstractType
{

//    private $uploaderHelper;
//    protected $requestStack;
//
//
//    public function __construct(UploaderHelper $uploaderHelper, RequestStack $requestStack)
//    {
//
//        $this->uploaderHelper = $uploaderHelper;
//        $this->requestStack = $requestStack;
//    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('en', null,[
//                'required' => false,
//            ])
            ->add('enFile', FileType::class, [
                'label' => 'Download dock En',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
//                    'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
            ->add('ruFile', FileType::class, [
                'label' => 'Загрузить документ Ru',
                'mapped' => false,
                'required' => false,
//                'constraints' => [
//                    new Image([
//                        'maxSize' => '2M'
//                    ])
            ])
//            ->add('ru', null, [
//                'required' => false,
//            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Docks::class,
        ]);
    }
}
