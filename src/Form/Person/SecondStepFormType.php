<?php

namespace App\Form\Person;

use App\Model\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
                new NotBlank(['message' => 'Pole wiek nie może być puste'])
            ]])
            ->add('colors', ChoiceType::class, [
                'constraints' => [new NotBlank(['message' => 'Pole kolory nie może być puste'])],
                'required' => true,
                'choices' => array_flip(Person::$colorList),
                'multiple' => true,
            ]);

        $builder->addEventListener(FormEvents::SUBMIT, function(FormEvent $event) {
            $data = $event->getData();
            if ($data === null) {
                return;
            }

            $form = $event->getForm();
            if ($data->getCountColors() !== 1  && $data->getCountColors() !== \count(Person::$colorList)) {
                $form->addError(new FormError('Można wybrać albo 1 kolor albo wszystkie'));
            }
        });

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