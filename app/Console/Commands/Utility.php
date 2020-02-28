<?php

namespace App\Console\Commands;

use Carbon\Carbon;

class Utility
{
    public function getPaymentDate(Carbon $date)
    {
        if ($date->endOfMonth()->isWeekday()) {
            return $date->endOfMonth()->format('d-M-Y');
        }
        
        return  Carbon::createFromTimeStamp(strtotime("last Friday", $date->timestamp))->format('d-M-Y');
    }

    public function getBonusPaymentDate(Carbon $date)
    {
        $fifteenthDate = Carbon::createFromDate($date->year, $date->month, 15);

        if ($fifteenthDate->isWeekday()) {
            return $fifteenthDate->format('d-M-Y');
        }
        
        return  Carbon::createFromTimeStamp(strtotime("next Wednesday", $fifteenthDate->timestamp))->format('d-M-Y');
    }

    public function getRow(Carbon $date)
    {
        return "'" . $date->format("F") . "','" . $this->getPaymentDate($date) . "','" . $this->getBonusPaymentDate($date) . "'";
    }
}
