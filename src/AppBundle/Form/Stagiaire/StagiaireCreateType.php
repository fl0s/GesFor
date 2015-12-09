<?php

namespace AppBundle\Form\Stagiaire;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StagiaireCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add("prenom")
            ->add("dateNaissance", null, array(
                'widget' => 'single_text'
            ))
            ->add("reglement", 'choice', array(
                'choices' => array('CHQ', 'ESP'),
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Stagiaire',
        ));
    }

    public function getName()
    {
        return 'stagiaire';
    }

}