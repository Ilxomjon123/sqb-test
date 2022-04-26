<?php

namespace App\Services;

use App\Models\Currency;
use App\Services\Interfaces\CurrencyFilterInterface;

class CurrencyFilter implements CurrencyFilterInterface
{
  protected $currency;
  public function __construct()
  {
    $this->currency = Currency::class;
  }
  public function filter($request)
  {
    return $this->currency::where('valuteID', $request->get('valuteID', 'R01235'))
      ->whereBetween('date', [
        date('Y-m-d', strtotime($request->get('from', date('Y-m-d')))),
        date('Y-m-d', strtotime($request->get('to', date('Y-m-d'))))
      ])
      ->get();
  }
}
