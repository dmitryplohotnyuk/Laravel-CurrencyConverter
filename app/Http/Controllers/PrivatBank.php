<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivatBank extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, ['value' => 'required|numeric']);
        $currency = $this->getExchangeRate();
        $result = $request->value * $currency->buy;
        echo json_encode($result);
    }

    private function getExchangeRate()
    {
        $response = file_get_contents("https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5");
        $response = json_decode($response);

        foreach ($response as $currency) {
            if ($currency->ccy === "USD" && $currency->base_ccy === "UAH") {
                return $currency;
            }
        }
    }
}
