<?php

namespace App\Form;

interface CompanyInformationModel
{
    public function getCompanySymbol(): string;

    public function getStartDate(): \DateTimeInterface;

    public function getEndDate(): \DateTimeInterface;

    public function getEmail(): string;
}
