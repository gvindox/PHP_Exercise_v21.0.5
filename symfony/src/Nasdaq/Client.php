<?php

namespace App\Nasdaq;

interface Client
{
    /**
     * @return CompanyModel[]
     */
    public function getCompanies(): array;
}
