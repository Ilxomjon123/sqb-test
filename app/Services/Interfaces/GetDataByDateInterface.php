<?php

namespace App\Services\Interfaces;

interface GetDataByDateInterface
{
  public function handle($date);
  public function generate($date);
}
