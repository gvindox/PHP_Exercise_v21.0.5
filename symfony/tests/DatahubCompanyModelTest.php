<?php

namespace App\Tests;

use App\Datahub\DatahubCompanyModel;
use PHPUnit\Framework\TestCase;

class DatahubCompanyModelTest extends TestCase
{
    public function testGetCompanyName()
    {
        $company = new DatahubCompanyModel('Example Company', 'EXM');
        $this->assertEquals('Example Company', $company->getCompanyName());
    }

    public function testGetSymbol()
    {
        $company = new DatahubCompanyModel('Example Company', 'EXM');
        $this->assertEquals('EXM', $company->getSymbol());
    }

    public function testSetCompanyName()
    {
        $company = new DatahubCompanyModel();
        $company->setCompanyName('New Company');
        $this->assertEquals('New Company', $company->getCompanyName());
    }

    public function testSetSymbol()
    {
        $company = new DatahubCompanyModel();
        $company->setSymbol('SYM');
        $this->assertEquals('SYM', $company->getSymbol());
    }
}
