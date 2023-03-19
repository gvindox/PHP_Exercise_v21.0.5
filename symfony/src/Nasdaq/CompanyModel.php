<?php

declare(strict_types=1);

namespace App\Nasdaq;

interface CompanyModel
{
    public function getCompanyName(): string;

    public function getSymbol(): string;
}
