<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
use App\Models\TableMap;
use Validator;

class MapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('map.index');
    }

    public function show(Request $request)
    {
        $map = Map::where('id', $request->id)->with('maps')->get();
        return response()->json($map, 200);
    }

    public function update(Request $request)
    {
        $validator      = Validator::make($request->all(), [
            'lettini_number' => 'required|numeric',
            'lettini_price' => 'required|numeric',
            'morning_price' => 'required|numeric',
            'afternoon_price' => 'required|numeric',
            'full_day_price' => 'required|numeric',
            'saturday_price' => 'required|numeric',
            'sunday_price' => 'required|numeric',
            'low_summer_price' => 'required|numeric',
            'high_summer_price' => 'required|numeric',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with("error", $validator->errors()->first());
        }

        $map = Map::find($request->id);
        $map->lettini_number = $request->lettini_number;
        $map->lettini_price    = $request->lettini_price;
        $map->save();

        TableMap::where('map_id', $map->id)->update([
            'morning_price' => $request->morning_price,
            'afternoon_price' => $request->afternoon_price,
            'full_day_price' => $request->full_day_price,
            'saturday_price' => $request->saturday_price,
            'sunday_price' => $request->sunday_price,
            'low_summer_price' => $request->low_summer_price,
            'hight_summer_price' => $request->high_summer_price,
        ]);
        return redirect()->back()->with("success", __("Informazioni create con successo."));
    }

    public function updateGazebo(Request $request)
    {
        $validator      = Validator::make($request->all(), [
            'gazebo_number' => 'required|numeric',
            'gazebo_price' => 'required|numeric',
            'morning_price' => 'required|numeric',
            'afternoon_price' => 'required|numeric',
            'full_day_price' => 'required|numeric',
            'saturday_price' => 'required|numeric',
            'sunday_price' => 'required|numeric',
            'low_summer_price' => 'required|numeric',
            'high_summer_price' => 'required|numeric',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with("error", $validator->errors()->first());
        }

        $map = Map::find($request->id);
        $map->gazebo_number = $request->gazebo_number;
        $map->gazebo_price    = $request->gazebo_price;
        $map->save();

        TableMap::where('map_id', $map->id)->update([
            'morning_price' => $request->morning_price,
            'afternoon_price' => $request->afternoon_price,
            'full_day_price' => $request->full_day_price,
            'saturday_price' => $request->saturday_price,
            'sunday_price' => $request->sunday_price,
            'low_summer_price' => $request->low_summer_price,
            'hight_summer_price' => $request->high_summer_price,
        ]);
        return redirect()->back()->with("success", __("Informazioni create con successo."));
    }
}
