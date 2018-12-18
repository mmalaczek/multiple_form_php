<?php

namespace App\Form\Person;

use App\Model\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SecondStepFormType extends AbstractType
{
    public const FORM_NAME = 'second_step';

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('age', TextType::class, ['constraints' => [
                new NotBlank()
            ]])
            ->add('colors', ChoiceType::class, [
                'constraints' => [new NotBlank()],
                'required' => true,
                'choices' => array_flip(Person::$colorList),
                'multiple' => true,
            ]);
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