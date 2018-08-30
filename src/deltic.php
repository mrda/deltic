#!/usr/bin/env php

<?php

require_once("DTCUtils.php");

/* use \DateTimeZone; */

/**
 * The minimum number of command line arguments we require
 */
const MIN_ARGS = 5;

/**
 * Display the usage help text and kill the PHP process
 * @param String $extra any extra text to print
 */
function displayUsageAndDie($extra=NULL) {
    $script = basename(__FILE__);
    if (! is_null($extra)) {
        print("$extra\n");
    }
    die("Usage: $script: <datetime1> <tz1> <datetime2> <tz2>\n");
}


# Ensure we have the right number of command line params
if ($argc != MIN_ARGS) {
    displayUsageAndDie();
}

# This just needs to be set to something, we use timezones for each
# datetimestamp, so what is specified here is irrelevant
date_default_timezone_set("UTC");

$firstDt = DTCUtils::parseDatetimeAndTz($argv[1], $argv[2]);
$secondDt = DTCUtils::parseDatetimeAndTz($argv[3], $argv[4]);

if ($firstDt == False or $secondDt == False) {
    displayUsageAndDie("Problem parsing datetime or timezone");
}


print("You provided the starting date as \"" .
    DTCUtils::getDateTimeAsStr($firstDt) . "\"\n");

print("and the ending date as \"" .
    DTCUtils::getDateTimeAsStr($secondDt) . "\"\n");

print("\nCalculating the number of weekdays...\n\n");

$numWeekdays = DTCUtils::getNumberOfWeekdays($firstDt, $secondDt);
print("The number of weekdays is $numWeekdays\n");

?>
