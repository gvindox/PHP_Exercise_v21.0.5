<?php

declare(strict_types=1);

namespace App\Form;

use App\Validator\CompanySymbolConstraint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class CompanyInformationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'company_symbol',
                TextType::class,
                [
                    'label' => 'Company Symbol',
                    'constraints' =>
                        [
                            new NotBlank(message: 'Company Symbol is required'),
                            new CompanySymbolConstraint()
                        ]
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
                    'constraints' => new NotBlank(message: 'Start Date is required')
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
                    'constraints' => new NotBlank(message: 'End Date is required')
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'constraints' => [
                        new NotBlank(message: 'Email is required'),
                        new Email(message: 'Email is not valid')
                    ]
                ]
            )
            ->add('submit', SubmitType::class, ['label' => 'Submit Form']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
