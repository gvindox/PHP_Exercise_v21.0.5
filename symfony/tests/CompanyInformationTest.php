<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\CompanyInformation;
use PHPUnit\Framework\TestCase;

class CompanyInformationTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $companyInformation = new CompanyInformation();

        $this->assertNull($companyInformation->getId());
        $this->assertNull($companyInformation->getCompanyName());
        $this->assertNull($companyInformation->getSymbol());

        $companyName = 'Test Company';
        $symbol = 'TEST';

        $companyInformation
            ->setCompanyName($companyName)
            ->setSymbol($symbol);

        $this->assertEquals($companyName, $companyInformation->getCompanyName());
        $this->assertEquals($symbol, $companyInformation->getSymbol());
    }
}

