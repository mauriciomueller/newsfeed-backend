<?php

namespace App\Services\News\DateRanges;

class LastHour extends AbstractDateRangeInterface
{
    public function getDate(): string
    {
        $lastHour = $this->currentTime->modify('-1 hour');
        return $lastHour->format($this->dateFormat);
    }
}
