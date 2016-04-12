<?php

namespace App\Helpers;

class Fixer {

    const BASE_URL = 'http://api.fixer.io/';

    public static function exchange($date = 'latest', $base = 'GBP', $symbols = array('USD', 'EUR', 'HUF'))
    {
        $url = Fixer::BASE_URL.(!empty($date) && $date != 'latest' ? date('Y-m-d', strtotime($date)) : $date);

        $url .= '?base='.$base;
        $url .= '&symbols='.(is_array($symbols) ? implode(',', $symbols) : $symbols);

        $contents = Utils::file_get_contents_curl($url);

        $array = json_decode($contents, true);

        return $array;
    }

}