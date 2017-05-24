<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helper
{
    public function currencyFormat($num)
    {
        return sprintf('$%s', number_format($num, 0));
    }

    public function datetimepickerToCarbon($dateStr)
    {
        return Carbon::createFromFormat('d/m/Y H:i', $dateStr);
    }

    public function dateSqlToDatetime($dateStr)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $dateStr);
    }

    public function datepickerToCarbon($dateStr)
    {
        return Carbon::createFromFormat('d/m/Y', $dateStr);
    }

    public function datepickerToDateStr($datetimepickerStr)
    {
        return $this->datepickerToCarbon($datetimepickerStr)
            ->toDateString();
    }

    public function datetimepickerToDatetimeStr($datetimepickerStr)
    {
        return $this->datetimepickerToCarbon($datetimepickerStr)
            ->toDateTimeString();
    }

    public function carbonToDisplayDateStr(Carbon $carbon = null)
    {
        if (empty($carbon)) {
            return '';
        }
        return $carbon->format('d/m/Y');
    }

    public function carbonToDisplayDatetimeStr(Carbon $carbon = null)
    {
        if (empty($carbon)) {
            return '';
        }
        return $carbon->format('d/m/Y H:i');
    }
}
