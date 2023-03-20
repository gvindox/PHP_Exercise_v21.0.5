<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class CompanySymbolConstraint extends Constraint
{
    public const STRING_PARAM = '{{ string }}';
    public string $message = 'The company symbol "'.self::STRING_PARAM.'" is not valid.';

    public function validatedBy(): string
    {
        return CompanySymbolValidator::class;
    }
}
