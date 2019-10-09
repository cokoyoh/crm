<?php

function processName(string $name) : array
{
    $explodedNameArray = explode(' ', trim($name));

    if (count($explodedNameArray) == 1) {
        return [
            $explodedNameArray[0],
            ''
        ];
    } elseif (count($explodedNameArray) == 2) {
        return [
            $explodedNameArray[0],
            $explodedNameArray[1]
        ];
    } else {
        $spacePosition = strrpos(trim($name), ' ');

        return [
            substr(trim($name), 0, $spacePosition),
            trim(substr(trim($name), $spacePosition))
        ];
    }
}
