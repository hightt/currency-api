<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Requests\v1\CurrencyStoreRequest;
use App\Http\Resources\v1\CurrencyResource;
use App\Http\Resources\v1\CurrencyCollection;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currencies = $this->currencyFilter($request);
        return new CurrencyCollection($currencies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyStoreRequest $request)
    {
        $check = Currency::where(['name' => strtoupper($request->name), 'date' => $request->date])->first();
        if(isset($check)) {
            return response()->json(['status' => false, 'message' => sprintf("Dane na temat waluty: %s zostały już dziś dodane (%s)", strtoupper($request->name), $request->date)], 409);
        }

        Currency::create(['name' => strtoupper($request->name), 'date' => $request->date, 'amount' => $request->amount]);
        return response()->json(['status' => true, 'message' => "Pomyślnie dodano dane walutowe."], 200);
    }

    public function currencyFilter(Request $request)
    {
        $currencies = Currency::all();

        if($request->has('date')) {
            $currencies = $currencies->where('date', $request->date);
        }
        if($request->has('currency')) {
            $currencies = $currencies->where('name', $request->currency);
        }

        return $currencies;
    }
}
