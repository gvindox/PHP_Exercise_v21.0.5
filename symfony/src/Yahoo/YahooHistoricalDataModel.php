<?php

namespace App\Yahoo;

use App\HistoricalData\HistoricalDataModelInterface;

class YahooHistoricalDataModel implements HistoricalDataModelInterface
{
    private int $date = 0;
    private float $open = 0;
    private float $high = 0;
    private float $low = 0;
    private float $close = 0;
    private int $volume = 0;

    public function getDate(): int
    {
        return $this->date;
    }

    public function setDate(int $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getOpen(): float
    {
        return $this->open;
    }

    public function setOpen(float $open): self
    {
        $this->open = $open;
        return $this;
    }

    public function getHigh(): float
    {
        return $this->high;
    }

    public function setHigh(float $high): self
    {
        $this->high = $high;
        return $this;
    }

    /**
     * @return float
     */
    public function getLow(): float
    {
        return $this->low;
    }

    public function setLow(float $low): self
    {
        $this->low = $low;
        return $this;
    }

    public function getClose(): float
    {
        return $this->close;
    }

    public function setClose(float $close): self
    {
        $this->close = $close;
        return $this;
    }

    public function getVolume(): int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): self
    {
        $this->volume = $volume;
        return $this;
    }
}
