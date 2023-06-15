<?php
namespace App\Supports;
class UtilSupport{
    public static function timezoneList() {
        $timezones = [];
        $offsets = [];
        $now = new \DateTime('now', new \DateTimeZone('UTC'));

        foreach (\DateTimeZone::listIdentifiers() as $timezone) {
            $now->setTimezone(new \DateTimeZone($timezone));
            $offsets[] = $offset = $now->getOffset();
            $timezones[$timezone] = '(' . self::formatGMTOffset($offset) . ') ' . self::formatTimezoneName($timezone);
        }

        array_multisort($offsets, $timezones);

        return $timezones;
    }

    public static function formatGMTOffset($offset) {
        $hours = intval($offset / 3600);
        $minutes = abs(intval($offset % 3600 / 60));
        return 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
    }

    public static function formatTimezoneName($name) {
        $name = str_replace('/', ', ', $name);
        $name = str_replace('_', ' ', $name);
        $name = str_replace('St ', 'St. ', $name);
        return $name;
    }
}