<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextareaType::class, ['required' => true, 'constraints' => [new NotBlank(), new NotNull()]])
            ->add('price', NumberType::class, ['required' => true, 'constraints' => [new NotNull()]])
            ->add('bedRoomCount', NumberType::class, ['required' => true, 'constraints' => [new NotNull()]])
            ->add('bedCount', NumberType::class, ['required' => true, 'constraints' => [new NotNull()]])
            ->add('personCount', NumberType::class, ['required' => true, 'constraints' => [new NotNull()]])
            ->add('bathRoomCount', NumberType::class, ['required' => true, 'constraints' => [new NotNull()]])
            ->add('address', AddressType::class)
            ->add('equipments', EquipmentType::class)
            ->add('user', UserType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}
