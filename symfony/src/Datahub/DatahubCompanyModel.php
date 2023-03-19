<?php

declare(strict_types=1);

namespace App\Datahub;

use App\Nasdaq\CompanyModel;
use Symfony\Component\Serializer\Annotation\SerializedName;

class DatahubCompanyModel implements CompanyModel
{
    public function __construct(
        #[SerializedName('Company Name')]
        private string $companyName = '',
        #[SerializedName('Symbol')]
        private string $symbol = ''
    ) {
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }
}
