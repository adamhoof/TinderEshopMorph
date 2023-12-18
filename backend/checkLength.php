<?php

/**
 * Contains the function for validating the length of an input.
 *
 * This script includes a utility function to check if a given input
 * string falls within a specified length range.
 */

/**
 * Validates the length of a given input string.
 *
 * Checks if the length of the input string is within the specified range.
 * The function takes an input string and optional minimum and maximum length
 * parameters. If the length of the input string is outside of this range,
 * the function returns false; otherwise, it returns true.
 *
 * @param string $inputValue The input string to validate.
 * @param int $minLength The minimum acceptable length of the input string. Default is 3.
 * @param int $maxLength The maximum acceptable length of the input string. Default is 255.
 * @return bool Returns true if the length of $inputValue is between $minLength and $maxLength, false otherwise.
 */
function inputLengthValid(string $inputValue, int $minLength = 3, int $maxLength = 255): bool
{
    $inputValueLength = strlen($inputValue);
    if ($inputValueLength < $minLength || $inputValueLength > $maxLength) {
        return false;
    }
    return true;
}