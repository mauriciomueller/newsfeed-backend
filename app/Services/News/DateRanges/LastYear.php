<?php

namespace App\Services\News\DateRanges;

class LastYear extends AbstractDateRangeInterface
{
    public function getDate(): string
    {
        $lastHour = $this->currentTime->modify('-1 year');
        return $lastHour->format($this->dateFormat);
    }
}
