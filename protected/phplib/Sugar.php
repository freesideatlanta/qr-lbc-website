<?php

/**
 * Disorganized heap of esoteric helpers that came from
 * a miserable lack of testing. Remove once automated
 * testing is implemented.
 */
class Sugar
{
    /**
     * Force plain-text dump of variable as server response.
     * Terminates request immediately.
     *
     * @param string $var Data to dump as plain text.
     * @return void
     */
    public static function dump($var)
    {
        header('Content-Type: text/plain');
        die(var_export($var));
    }

    /**
     * Checks to see if JSON is valid
     * 
     * @param string $string Any string
     * @return bool True if $string is valid json
     */
    public static function is_json($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

