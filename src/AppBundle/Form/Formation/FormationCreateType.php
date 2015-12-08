<?php

namespace AppBundle\Form\Formation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', null, array(
            'date_widget' => 'single_text',
            'time_widget' => 'single_text',
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Formation',
        ));
    }

    public function getName()
    {
        return "formation";
    }

}