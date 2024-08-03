<?php

namespace App\Form;

use App\Entity\Main\TenantDbConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TenantDbConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dbHost', ChoiceType::class, [
                'choices' => [
                    'Docker Host ' => 'host.docker.internal',
                ],
                'label' => 'DB Host',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('dbName', TextType::class, [
                'label' => 'DB Name',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter DB Name'],
            ])
            ->add('dbPort', ChoiceType::class, [
                'choices' => [
                    'Tenant Host 1' => '4444',
                    'Tenant Host 2' => '5555',
                    'Tenant Host 3' => '6666',
                    'Tenant Host 4' => '7777',
                    'Tenant Host 5' => '8888',
                ],
                'label' => 'DB port number from existing  tenants hosts',
                'attr' => ['class' => 'form-control'],
                'data' => '4444', // Default value
            ])

            ->add('save', SubmitType::class, [
                'label' => 'Add DB Config',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TenantDbConfig::class,
        ]);
    }
}
