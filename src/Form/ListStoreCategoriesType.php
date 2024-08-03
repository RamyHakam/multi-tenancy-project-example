<?php

namespace App\Form;

use App\Entity\Main\TenantDbConfig;
use App\Entity\Main\TenantUser;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListStoreCategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tenantUser', EntityType::class, [
                'class' => TenantUser::class,
                'choice_label' => 'email', // Assuming TenantUser has an 'email' field
                'label' => 'Select Tenant User',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('list', SubmitType::class, [
                'label' => 'List Store Categories',
                'attr' => ['class' => 'btn btn-primary mt-3'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
