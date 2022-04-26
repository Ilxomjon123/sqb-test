<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Services\Interfaces\CurrencyFilterInterface;
use App\Services\Interfaces\GenerateNext30DaysDataInterface;
use App\Services\Interfaces\GetDataByDateInterface;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index(Request $request, GenerateNext30DaysDataInterface $generate)
    {
        $generate->handle();
        return 'The database was replenished with data for the next 30 days';
    }

    public function sqb(Request $request, GetDataByDateInterface $getData)
    {
        $date = $request->get('date', date('Y-m-d'));
        $result = Currency::whereDate('date', $date)->exists();
        if (!$result) {
            $getData->generate($date);
        }
        $result = Currency::whereDate('date', $date)->get();
        return view('sqb', compact('result'));
    }

    public function one(Request $request, CurrencyFilterInterface $filter)
    {
        $valutes = Currency::whereDate('date', date('Y-m-d'))->get();
        $result = $filter->filter($request);
        return view('one', compact('result', 'valutes'));
    }
}
