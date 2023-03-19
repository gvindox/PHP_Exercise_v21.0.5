<?php

declare(strict_types=1);

namespace App\Validator;

use App\Repository\CompanyInformationRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class CompanySymbolValidator extends ConstraintValidator
{
    public function __construct(private CompanyInformationRepository $companyInformationRepository)
    {
    }

    public function validate(mixed $value, Constraint $constraint)
    {
        $this->checkConstraint($constraint);
        $this->checkValue($value);

        $companyInformation = $this->companyInformationRepository->findBySymbol($value);

        if (!$companyInformation) {
            $this->context->buildViolation($constraint->message)
                ->setParameter(CompanySymbolConstraint::STRING_PARAM, $value)
                ->addViolation();
        }
    }

    private function checkConstraint(Constraint $constraint): void
    {
        if (!$constraint instanceof CompanySymbolConstraint) {
            throw new UnexpectedTypeException($constraint, CompanySymbolConstraint::class);
        }
    }

    private function checkValue(mixed $value): void
    {
        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }
    }
}
