<?php

namespace App\Services;

use App\Models\Currency;
use App\Services\Interfaces\GetDataByDateInterface;
use Illuminate\Support\Facades\Http;

class GetDataByDate implements GetDataByDateInterface
{
  public function handle($date)
  {
    $response = Http::get('http://www.cbr.ru/scripts/XML_daily.asp', [
      'date_req' => $date,
    ]);
    $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
    $json = json_encode($xml);
    $array = json_decode($json, true);
    return $array;
  }

  public function generate($date)
  {
    $obj = new GenerateNext30DaysData();
    $data = $this->handle(date('d/m/Y', strtotime($date)));
    $obj->generate($data, $date);
  }
}
