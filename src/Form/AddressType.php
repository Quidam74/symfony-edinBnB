<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country')
            ->add('city')
            ->add('postCode')
            ->add('complement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
            'csrf_protection'   => false,

        ]);
    }
}
