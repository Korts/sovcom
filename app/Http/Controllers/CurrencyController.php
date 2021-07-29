<?php

namespace App\Http\Controllers;


use App\Models\ExchangeRate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'currency' => ['required', 'string'],
            'buy' => ['required', 'numeric'],
            'sell' => ['required', 'numeric'],
            'begins_at' => ['required', 'date'],
            'office_id' => ['nullable', 'string'],
        ]);

        $newRate = new ExchangeRate();
        $newRate->currency = $validatedData['currency'];
        $newRate->buy = $validatedData['buy'];
        $newRate->sell = $validatedData['sell'];
        $newRate->begins_at = new Carbon($validatedData['begins_at']);
        $newRate->office_id = $validatedData['office_id'];
        $newRate->save();

        return response()->noContent();
    }

    public function list(Request $request)
    {
        $validatedData = $request->validate([
            'office_id' => ['required', 'string'],
            'at_date' => ['required', 'date'],
        ]);

        $rateList = ExchangeRate::query()
            ->where(function ($query) use ($validatedData) {
                $query->where('office_id', null)
                    ->orWhere('office_id', $validatedData['office_id']);
            })
            ->where('begins_at', '<=', new Carbon($validatedData['at_date']))
            ->get()->toArray();

        return response()->json($rateList);
    }
}
