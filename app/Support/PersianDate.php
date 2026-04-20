<?php

namespace App\Support;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use DateTimeInterface;
use IntlDateFormatter;

class PersianDate
{
    public static function format(DateTimeInterface|string|null $value, bool $withTime = false): string
    {
        if (!$value) {
            return '-';
        }

        try {
            $date = $value instanceof DateTimeInterface ? $value : Carbon::parse($value);
        } catch (\Throwable $e) {
            return (string)$value;
        }

        $pattern = $withTime ? 'yyyy/MM/dd HH:mm' : 'yyyy/MM/dd';
        $formatter = new IntlDateFormatter(
            'fa_IR@calendar=persian',
            IntlDateFormatter::FULL,
            IntlDateFormatter::SHORT,
            config('app.timezone', 'UTC'),
            IntlDateFormatter::TRADITIONAL,
            $pattern
        );

        $formatted = $formatter->format($date);
        return $formatted !== false ? $formatted : $date->format($withTime ? 'Y-m-d H:i' : 'Y-m-d');
    }

    public static function yearMonth(DateTimeInterface|string|null $value): string
    {
        if (!$value) {
            return '-';
        }

        try {
            $date = $value instanceof DateTimeInterface ? $value : Carbon::parse($value);
        } catch (\Throwable $e) {
            return (string) $value;
        }

        $formatter = new IntlDateFormatter(
            'fa_IR@calendar=persian',
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            config('app.timezone', 'UTC'),
            IntlDateFormatter::TRADITIONAL,
            'yyyy/MM'
        );

        $formatted = $formatter->format($date);

        return $formatted !== false ? $formatted : $date->format('Y/m');
    }

    public static function inputValue(DateTimeInterface|string|null $value): string
    {
        if (!$value) {
            return '';
        }

        try {
            $date = $value instanceof DateTimeInterface ? $value : Carbon::parse($value);
        } catch (\Throwable $e) {
            return '';
        }

        if ($date instanceof CarbonInterface) {
            return $date->format('Y-m-d');
        }

        return $date->format('Y-m-d');
    }
}
