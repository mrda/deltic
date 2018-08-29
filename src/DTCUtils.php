<?php

class DTCUtils
{
    private static $DATE_FORMAT = 'Y-m-d H:i:s';

    public static function get_number_of_weekdays(\DateTime $start_dt,
                                                  \DateTime $end_dt) {
        $number_of_weekdays = 0;

        while($end_dt->diff($start_dt)->days > 0) {
            $number_of_weekdays += DTCUtils::is_weekday($start_dt) ? 1 : 0;
            $start_dt = $start_dt->add(new \DateInterval("P1D"));
        }

        return $number_of_weekdays;
    }

    public static function is_weekday (\DateTime $dt) {
        return $dt->format('N') < 6;
    }

    public static function get_datetime_as_str($dt) {
        $tz = $dt->getTimeZone()->getName();
        $str = $dt->format(DTCUtils::$DATE_FORMAT);
        return "$str $tz";
    }

    public static function is_valid_tz($tz) {
        return (in_array($tz, DateTimeZone::listIdentifiers()));
    }

    public static function parse_datetime_and_tz($dt, $tz) {
        if (! DTCUtils::is_valid_tz($tz)) {
            display_usage_and_die("Invalid timezone: $tz");
        }
        $tz = new \DateTimeZone($tz);

        # Create a datetime object in the specified timezone
        $datetime = DateTime::createFromFormat(DTCUtils::$DATE_FORMAT,
                                               $dt, $tz);
        if (DateTime::getLastErrors()["warning_count"] != 0 &&
            DateTime::getLastErrors()["error_count"] != 0) {
            return False;
        } else {
            return $datetime;
        }
    }
}
?>
