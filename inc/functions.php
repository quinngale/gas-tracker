<?php
function uuid_bin()
{
    // All credit goes to https://stackoverflow.com/a/15875555

    $bytes = random_bytes(16);

    // Set version to 0100
    $bytes[6] = chr(ord($bytes[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $bytes[8] = chr(ord($bytes[8]) & 0x3f | 0x80);

    return $bytes;
}

function uuid_str($uuid = null)
{
    $bin = $bin ?? uuid_bin();

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bin), 4));
}
