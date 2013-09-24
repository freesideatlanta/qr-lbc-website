<?php

/**
 * Disorganized heap of esoteric helpers for convinience
 */

class Sugar
{
    // Force server to respond with text dump of variable
    public static function dump($var)
    {
        header('Content-Type: text/plain');
        die(var_export($var));
    }

    // Checks to see if JSON is valid
    public static function is_json($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

