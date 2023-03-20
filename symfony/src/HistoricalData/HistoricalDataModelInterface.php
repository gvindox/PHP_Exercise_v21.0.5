<?php

declare(strict_types=1);

namespace App\HistoricalData;

interface HistoricalDataModelInterface
{
    public function getDate(): int;

    public function getOpen(): float;

    public function getHigh(): float;

    public function getLow(): float;

    public function getClose(): float;

    public function getVolume(): int;
}
