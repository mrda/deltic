#!/usr/bin/env php

<?php

require_once("DTCUtils.php");

use \DateTimeZone;


function display_usage_and_die($extra=NULL) {
    $script = basename(__FILE__);
    if (! is_null($extra)) {
        print("$extra\n");
    }
    die("Usage: $script: <datetime1> <tz1> <datetime2> <tz2>\n");
}


# Ensure we have the right number of command line params
if ($argc != 5) {
    display_usage_and_die();
}

# This just needs to be set to something, we use timezones for each
# datetimestamp, so what is specified here is irrelevant
date_default_timezone_set("UTC");

$first_dt = DTCUtils::parse_datetime_and_tz($argv[1], $argv[2]);
$second_dt = DTCUtils::parse_datetime_and_tz($argv[3], $argv[4]);

if ($first_dt == False or $second_dt == False) {
    display_usage_and_die("Problem parsing datetime or timezone");
}

print("You provided the starting date as \"" .
      DTCUtils::get_datetime_as_str($first_dt) . "\"\n");
print("and the ending date as \"" .
      DTCUtils::get_datetime_as_str($second_dt) . "\"\n");
print("\nCalculating the number of weekdays...\n\n");
$num_weekdays = DTCUtils::get_number_of_weekdays($first_dt, $second_dt);
print("The number of weekdays is $num_weekdays\n");

?>
