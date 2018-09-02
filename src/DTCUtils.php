<?php

/**
 * Utility functions for working with date times
 */
class DTCUtils
{
    /** The format for our dates */
    private static $DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * Get the number of weekdays between two date times
     *
     * @param \DateTime $startDt
     * @param \DateTime $endDt
     * @return int
     */
    public static function getNumberOfWeekdays(\DateTime $startDt, \DateTime $endDt) {
        $numberOfWeekdays = 0;

        while($endDt->diff($startDt)->days > 0) {
            $numberOfWeekdays += DTCUtils::isWeekday($startDt) ? 1 : 0;
            $startDt = $startDt->add(new \DateInterval("P1D"));
        }

        return $numberOfWeekdays;
    }

    /**
     * Returns whether the the given datetime is a weekday or not
     *
     * @param \DateTime $dt
     * @return bool
     */
    public static function isWeekday(\DateTime $dt) {
        return $dt->format('N') < 6;
    }

    /**
     * Get the given datetime as a string
     *
     * @param \DateTime $dt
     * @return String
     */
    public static function getDateTimeAsStr(\DateTime $dt) {
        $tz = $dt->getTimeZone()->getName();
        $str = $dt->format(DTCUtils::$DATE_FORMAT);
        return "$str $tz";
    }

    /**
     * Returns whether the given timezone is valid with regards to the ones that are available in PHP
     *
     * @param String $tz
     * @return bool
     */
    public static function isValidTz($tz) {
        return (in_array($tz, DateTimeZone::listIdentifiers()));
    }

    /**
     * Parse the given parameters as a datetime and timezone object
     *
     * @param String $dt the datetime to be parsed
     * @param String $tz the timezone to be parsed
     * @return DateTime the parsed datetime with the timezone configured
     */
    public static function parseDatetimeAndTz($dt, $tz) {
        if (! DTCUtils::isValidTz($tz)) {
            return False;
        }
        $tz = new \DateTimeZone($tz);

        # Create a datetime object in the specified timezone
        $datetime = DateTime::createFromFormat(DTCUtils::$DATE_FORMAT, $dt, $tz);
        $errors = DateTime::getLastErrors();

        if ($errors["warning_count"] != 0 && $errors["error_count"] != 0) {
            return False;
        }

        return $datetime;
    }
}
?>
