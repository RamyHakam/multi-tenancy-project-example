<?php

// src/Form/StoreCategoryType.php
namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Main\TenantUser; // Assume you have a TenantUser entity

class StoreCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categoryName', TextType::class, [
                'label' => 'Category Name',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter Category Name'],
            ])
            ->add('tenantUser', EntityType::class, [
                'class' => TenantUser::class,
                'choice_label' => 'email', // Assuming TenantUser has an 'email' field
                'label' => 'Select Tenant User',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Add Store Category',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }
}
