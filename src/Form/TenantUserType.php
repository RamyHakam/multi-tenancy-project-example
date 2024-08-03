<?php

namespace App\Form;

use App\Entity\Main\TenantDbConfig;
use App\Entity\Main\TenantUser;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TenantUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tenantDbConfig', EntityType::class, [
                'class' => TenantDbConfig::class,
                'choice_label' => 'dbname',
                'label' => 'Select Tenant Db',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'User Email',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter User Email'],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'User Password',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter User Password'],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Add Tenant User',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TenantUser::class,
        ]);
    }
}
