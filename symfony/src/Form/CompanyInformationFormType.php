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
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
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
                    'input' => 'string',
                    'format' => 'y-mm-dd',
                    'constraints' =>
                    [
                        new NotBlank(message: 'Start Date is required'),
                        new Date(),
                        new LessThanOrEqual([
                            'value' => 'now',
                            'message' => 'Start date must be less than or equal to current date'
                        ]),
                        new LessThanOrEqual([
                            'propertyPath' => 'parent.all[end_date].data',
                            'message' => 'Start date must be less than or equal to end date'
                        ]),
                    ]
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
                    'format' => 'y-mm-dd',
                    'input' => 'string',
                    'constraints' =>
                        [
                            new NotBlank(message: 'End Date is required'),
                            new Date(),
                            new LessThanOrEqual([
                                'value' => 'now',
                                'message' => 'End date must be less than or equal to current date'
                            ]),
                            new GreaterThanOrEqual([
                                'propertyPath' => 'parent.all[start_date].data',
                                'message' => 'End date must be greater than or equal to start date'
                            ]),
                        ]
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
