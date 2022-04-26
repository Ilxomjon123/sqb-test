<?php

namespace App\Services\Interfaces;

interface GenerateNext30DaysDataInterface
{
  public function handle($days = 30);
}
