<?php

namespace App\Form;

use App\Entity\Trainee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TraineeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'choices' => Trainee::GENDERS,
                'choice_label' => function ($value) {
                    return sprintf('trainee.genders.%s', $value);
                },
                'expanded' => true,
            ])
            ->add('lastName')
            ->add('firstName')
            ->add('maidenName', null, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('birthDate', BirthdayType::class, [
                'input' => 'datetime_immutable',
            ])
            ->add('birthPlace')
            ->add('birthDepartment')
            ->add('adressLine')
            ->add('adressPostalCode')
            ->add('adressCity')
            ->add('phone')
            ->add('email')
            ->add('work', null, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('study', null, [
                'required' => false,
                'empty_data' => '',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trainee::class,
            'label_format' => 'trainee.form.field.%name%'
        ]);
    }
}
