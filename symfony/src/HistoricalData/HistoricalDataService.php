<?php

namespace App\HistoricalData;

use App\Form\CompanyInformationModel;

class HistoricalDataService implements HistoricalDataServiceInterface
{
    public function __construct(private HistoricalDataClientInterface $client)
    {
    }

    public function getHistoricalData(CompanyInformationModel $companyInformationSubmitModel): array
    {
        return $this->client->getHistoricalData(
            $companyInformationSubmitModel->getCompanySymbol(),
            $companyInformationSubmitModel->getStartDate(),
            $companyInformationSubmitModel->getEndDate()
        );
    }
}
