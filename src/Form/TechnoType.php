<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\TranslatorInterface;


use App\Entity\Techno;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TechnoType extends AbstractType
{
    private $translator;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class)
            ->add('background', TextType::class)
            ->add('color', TextType::class)
            ->add('save', SubmitType::class)
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Techno::class,
        ));
    }

}