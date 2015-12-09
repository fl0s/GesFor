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
            'widget' => 'single_text'
        ))
        ->add('antenne', null, array(
            'choice_label' => 'name'
        ))
        ->add('formateur')
        ->add('lieu')
        ->add('description')
        ->add('type', null, array(
            'choice_label' => 'titre'
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