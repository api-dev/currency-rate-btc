<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('/exchange-rate/{date}', function ($date) use ($app) {
    $data = array(
        'base_currency' => 'GBP',
        'currency' => 'HUF'
    );

    $exchangeRate = \App\Helpers\Fixer::exchange($date, $data['base_currency'], $data['currency']);
    $bitcoinRate = \App\Helpers\Cryptonator::bitcoin($data['base_currency']);

    $data['date'] = $exchangeRate['date'];
    $data['rate_currency'] = $exchangeRate['rates'][$data['currency']];

    $data['btc_base_rate'] = $bitcoinRate['ticker']['price'];
    $data['btc_currency_rate'] = $data['rate_currency'] * $data['btc_base_rate'];

    return response()->json($data);
});
