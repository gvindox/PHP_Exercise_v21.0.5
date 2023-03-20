<?php

namespace App\Form;

use App\Validator\CompanySymbolConstraint;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class CompanyInformationModelImpl implements CompanyInformationModel
{
    #[Assert\NotBlank(message: 'Company Symbol is required')]
    #[CompanySymbolConstraint]
    private string $companySymbol;
    #[Assert\NotBlank(message: 'Start Date is required')]
    #[Assert\Type("\DateTimeInterface")]
    #[Assert\LessThanOrEqual(value: new DateTime(), message: 'Start date must be less than or equal to current date')]
    #[Assert\LessThanOrEqual(
        propertyPath: 'endDate',
        message: 'Start date must be less than or equal to end date')
    ]
    private \DateTimeInterface $startDate;
    #[Assert\NotBlank(message: 'End Date is required')]
    #[Assert\Type("\DateTimeInterface")]
    #[Assert\LessThanOrEqual(value: new DateTime(), message: 'End date must be less than or equal to current date')]
    #[Assert\GreaterThanOrEqual(
        propertyPath: 'startDate',
        message: 'End date must be greater than or equal to start date')
    ]
    private \DateTimeInterface $endDate;

    #[Assert\NotBlank(message: 'Email is required')]
    #[Assert\Email(message: 'Email is not valid')]
    private string $email;

    public function getCompanySymbol(): string
    {
        return $this->companySymbol;
    }

    public function setCompanySymbol(string $companySymbol): self
    {
        $this->companySymbol = $companySymbol;
        return $this;
    }

    public function getStartDate(): \DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate(): \DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
}
