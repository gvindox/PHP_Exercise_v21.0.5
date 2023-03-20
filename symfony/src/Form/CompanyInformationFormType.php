<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyInformationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'company_symbol',
                TextType::class,
                [
                    'label' => 'Company Symbol'
                ]
            )
            ->add(
                'start_date',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker'],
                    'label' => 'Start Date',
                    'input' => 'datetime',
                ]
            )
            ->add(
                'end_date',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker'],
                    'label' => 'End Date',
                    'input' => 'datetime',
                ]
            )
            ->add(
                'email',
                EmailType::class,
            )
            ->add('submit', SubmitType::class, ['label' => 'Submit Form']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompanyInformationModelImpl::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'company_information',
        ]);
    }
}
