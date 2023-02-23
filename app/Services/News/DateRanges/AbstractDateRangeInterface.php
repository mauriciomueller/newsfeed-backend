<?php

namespace App\Services\News\DateRanges;

abstract class AbstractDateRangeInterface implements DateRangeInterface
{
    protected \DateTime $currentTime;
    protected string $dateFormat;

    public function __construct()
    {
        $this->currentTime = new \DateTime();
        $this->dateFormat = 'Y-m-d\TH:i:s';
    }
}
