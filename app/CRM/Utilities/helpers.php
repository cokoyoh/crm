<?php

use App\Mail\SimpleMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

function sendMail(array $data, $queue = true)
{
    if ($queue) {
        return Mail::queue(new SimpleMail($data));
    }

    Mail::send(new SimpleMail($data));
}

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

function getAdmins()
{
    return explode(',', getenv('ADMIN_EMAILS'));
}

function pluralise($string, $count = 1)
{
    return Str::plural($string, $count);
}

function getMessageLevel(String $level)
{
    $hyphenPosition = strpos($level, '-');

    $level = Str::substr($level, $hyphenPosition + 1, Str::length($level));

    return Str::ucfirst($level);
}
