<?php

namespace App\Services;

use App\Models\Currency;
use App\Services\Interfaces\GenerateNext30DaysDataInterface;

class GenerateNext30DaysData implements GenerateNext30DaysDataInterface
{

  public $date;
  public $getData;

  public function __construct()
  {
    $this->date = date('d/m/Y');
    $this->getData = new GetDataByDate();
  }

  public function handle($days = 30)
  {
    for ($i = 0; $i < $days; $i++) {
      $data = $this->getData->handle($this->date);
      $this->generate($data);
      $this->nextDate();
    }
  }

  public function nextDate($day = 1)
  {
    $this->date = date('d/m/Y', strtotime("+$day day", strtotime(str_replace('/', '-', $this->date))));
  }

  public function customizeData($data)
  {
    return [
      'valuteID' => $data['@attributes']['ID'],
      'numCode' => $data['NumCode'],
      'charCode' => $data['CharCode'],
      'name' => $data['Name'],
      'value' => str_replace(',', '.', $data['Value']),
    ];
  }

  public function customDate()
  {
    return date('Y-m-d', strtotime(str_replace('/', '-', $this->date)));
  }
  public function generate($data, $date = null)
  {
    if (empty($date)) {
      $date = $this->customDate();
    }
    if (isset($data['Valute'])) {
      foreach ($data['Valute'] as $el) {
        $el = $this->customizeData($el);
        Currency::updateOrCreate(
          [
            'date' => $date,
            'valuteID' => $el['valuteID']
          ],
          $el
        );
      }
    }
  }
}
