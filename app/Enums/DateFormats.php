<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use Illuminate\Support\Carbon;

/**
 * Class DateFormats
 */
final class DateFormats extends Enum
{
    const DATE          = 'd/m/Y';
    const DATE_HM       = 'd/m/Y H:i';
    const LONG_DATE     = "jS F Y";
    const DATETIME      = 'd/m/Y H:i:s';
    const DATE_KEY      = 'Ymd';
    const TIME          = 'H:i:s';
    const HOUR_MINUTE   = 'H:i';
    const DB            = 'Y-m-d H:i:s';
    const DB_DATE       = 'Y-m-d';

    /**
     * DateFormats::format()
     *
     * @param $date
     * @param string $format
     * @return string|null
     */
    public static function format($date, string $format): ?string
    {
        if (blank($date)) {
            return null;
        }

        return Carbon::parse($date)->format($format);
    }
}
