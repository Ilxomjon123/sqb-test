<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CurrencyRequest;
use App\Services\Interfaces\CurrencyFilterInterface;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index(CurrencyRequest $request, CurrencyFilterInterface $filter)
    {
        return response()->json($filter->filter($request));
    }
}
