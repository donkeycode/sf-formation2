<?php

namespace App\Form;

use App\Entity\BienModification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienModificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('latitude')
            ->add('longitude')
            ->add('localisation')
            ->add('state')
            ->add('proprietaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BienModification::class,
        ]);
    }
}
