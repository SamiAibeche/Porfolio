<?php

namespace App\Form;

use App\Controller\TechnoController;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\TranslatorInterface;


use App\Entity\Techno;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProjectType extends AbstractType
{
    private $translator;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('client', TextType::class)
            ->add('company', TextType::class)
            ->add('image', FileType::class, array('data_class' => null, 'required' => false, "empty_data"=>true))
            ->add('createdAt', DateType::class, array('widget' => 'single_text', 'html5' => false))
            //->add('createdAt', DateTimeType::class, array('required' => false, 'attr' => ['class' => 'js-datepicker']))
            ->add('technos', EntityType::class, ["class" => Techno::class, "multiple"=>true])
            ->add('save', SubmitType::class)
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Project::class,
        ));
    }

}