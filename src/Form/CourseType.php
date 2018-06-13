<?php

namespace App\Form;

use App\Entity\Course;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => Course::TYPES,
                'choice_label' => function ($value) {
                    return sprintf('course.types.%s', $value);
                },
            ])
            ->add('numberOfStudent')
            ->add('office', null, [
                'choice_label' => 'name',
            ])
            ->add('start')
            ->add('end')
            ->add('addressName')
            ->add('addressLine')
            ->add('postalCode')
            ->add('city')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
            'label_format' => 'course.form.field.%name%'
        ]);
    }
}
