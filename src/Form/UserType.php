<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, ['required' => true, 'constraints' => [new NotBlank(), new NotNull()]])
            ->add('lastName', TextType::class, ['required' => true, 'constraints' => [new NotBlank(), new NotNull()]])
            ->add('email', EmailType::class, ['required' => true, 'constraints' => [new NotBlank(), new NotNull()]])
            ->add('dateOfBirth', DateType::class, ['required' => true, 'constraints' => [new NotNull()]])
            ->add('hashPassword', PasswordType::class, ['required' => true, 'constraints' => [new NotBlank(), new NotNull()]])
            ->add('bankingReference', TextType::class, ['required' => true, 'constraints' => [new NotBlank(), new NotNull()]])
            ->add('isTraveler', CheckboxType::class, ['required' => true, 'constraints' => [new NotNull()]])
            ->add('address', AddressType::class, ['required' => true, 'constraints' => [new NotNull()]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
