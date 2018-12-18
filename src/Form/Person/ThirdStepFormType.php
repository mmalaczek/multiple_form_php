<?php

namespace App\Form\Person;

use App\Model\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ThirdStepFormType extends AbstractType
{
    public const FORM_NAME = 'third_step';

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('canSwim', CheckboxType::class);

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return self::FORM_NAME;
    }

}