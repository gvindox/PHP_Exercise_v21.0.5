<?php

namespace App\HistoricalData;

use App\Form\CompanyInformationModel;

interface HistoricalDataServiceInterface
{
    /**
     * @return HistoricalDataModelInterface[]
     */
    public function getHistoricalData(CompanyInformationModel $companyInformationSubmitModel): array;
}
