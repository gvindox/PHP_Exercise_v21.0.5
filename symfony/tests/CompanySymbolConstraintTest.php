<?php

namespace App\Tests;

use App\Validator\CompanySymbolConstraint;
use PHPUnit\Framework\TestCase;

class CompanySymbolConstraintTest extends TestCase
{
    public function testMessage()
    {
        $constraint = new CompanySymbolConstraint();
        $this->assertEquals('The company symbol "{{ string }}" is not valid.', $constraint->message);
    }

    public function testValidatedBy()
    {
        $constraint = new CompanySymbolConstraint();
        $this->assertEquals('App\Validator\CompanySymbolValidator', $constraint->validatedBy());
    }
}
