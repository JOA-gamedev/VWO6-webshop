<?php

class Validator
{
    public static function trim(mixed &$data): string|array
    {
        if (is_array($data)) {
            return array_map('trim', $data);
        }
        return trim($data ?? '');
    }

    public static function required(mixed &$data): bool
    {
        self::trim($data);
        return !empty($data);
    }

    public static function integer(mixed &$data): bool
    {
        self::trim($data);
        return is_int($data);
    }

    public static function length(string &$data, int $min = 1, int $max = INF): bool
    {
        self::trim($data);
        return strlen($data) >= $min && strlen($data) <= $max;
    }

    public static function email(string &$data): bool
    {
        self::trim($data);
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }

    public static function url(string &$data): bool
    {
        self::trim($data);
        return filter_var($data, FILTER_VALIDATE_URL);
    }

    public static function date(string &$data): bool
    {
        self::trim($data);
        return strtotime($data);
    }

    public static function min(mixed &$data, int|float $min): bool
    {
        self::trim($data);
        return $data >= $min;
    }

    public static function max(mixed &$data, int|float $max): bool
    {
        self::trim($data);
        return $data <= $max;
    }

    public static function between(mixed &$data, float|int $min, float|int $max): bool
    {
        self::trim($data);
        return $data >= $min && $data <= $max;
    }

    public static function in(mixed &$data, array $array): bool
    {
        self::trim($data);
        return in_array($data, $array);
    }

    public static function notIn(mixed &$data, array $array): bool
    {
        self::trim($data);
        return !in_array($data, $array);
    }

    public static function regex(string &$data, string $regex): bool
    {
        self::trim($data);
        return preg_match($regex, $data);
    }
}