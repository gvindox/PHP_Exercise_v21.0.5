<?php

declare(strict_types=1);

namespace App\HistoricalData;

interface HistoricalDataClientInterface
{
    /**
     * @return HistoricalDataModelInterface[]
     */
    public function getHistoricalData(string $symbol, \DateTimeInterface $dateFrom, \DateTimeInterface $dateTo): array;
}
