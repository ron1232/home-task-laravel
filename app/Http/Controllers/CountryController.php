<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\CountryRequest;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();

        return view("dashboard", [
            "countries" => $countries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        Country::create(["iso" => $request["iso"],"name" => $request["name"], 'user_id' => Auth::id()]);

        return redirect("/dashboard");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, string $id)
    {
        $foundCountry  = Country::where('id', $request->id)->where("user_id", Auth::id());
        if($foundCountry) $foundCountry->update(["iso" => $request["iso"], "name" => $request["name"]]);

        return response()->json(["message" => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $foundCountry  = Country::where('id', $id)->where("user_id", Auth::id());
        if($foundCountry) $foundCountry->delete();

        return redirect("/dashboard");
    }
}
