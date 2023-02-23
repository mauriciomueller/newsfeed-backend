<?php

namespace App\Services\News\DateRanges;

class LastWeek extends AbstractDateRangeInterface
{
    public function getDate(): string
    {
        $lastHour = $this->currentTime->modify('-7 days');
        return $lastHour->format($this->dateFormat);
    }
}
