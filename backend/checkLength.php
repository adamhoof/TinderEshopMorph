<?php
function inputLengthValid($inputValue, $minLength = 3, $maxLength = 255): bool
{
    $inputValueLength = strlen($inputValue);
    if ($inputValueLength < $minLength || $inputValueLength > $maxLength) {
        return false;
    }
    return true;
}