<?php

declare(strict_types=1);

namespace App\Nasdaq;

interface Client
{
    /**
     * @return CompanyModel[]
     */
    public function getCompanies(): array;
}
