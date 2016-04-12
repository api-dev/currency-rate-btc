<?php

namespace App\Helpers;

class Cryptonator {

    const BASE_URL = 'https://www.cryptonator.com/api/ticker/btc-';

    public static function bitcoin($currency = 'GBP')
    {
        $contents = Utils::file_get_contents_curl(Cryptonator::BASE_URL.$currency);

        $array = json_decode($contents, true);

        return $array;
    }
}