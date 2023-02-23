<?php

namespace App\Services\News\DateRanges;

class Last24Hour extends AbstractDateRangeInterface
{
    public function getDate(): string
    {
        $lastHour = $this->currentTime->modify('-24 hour');
        return $lastHour->format($this->dateFormat);
    }
}
