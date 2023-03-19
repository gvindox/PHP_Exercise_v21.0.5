<?php

namespace App\Nasdaq;

interface CompanyModel
{
    public function getCompanyName(): string;
    public function getSymbol(): string;
}
