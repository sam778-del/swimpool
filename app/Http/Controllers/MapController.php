<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
use App\Models\Specification;
use App\Models\Row;
use App\Models\Column;
use Validator;

class MapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'column' => $this->getColumn(),
            'row'    => $this->getRow()
        ];
        return view('map.index', compact('data'));
        //return array_chunk($this->getRow(), count($this->getColumn()));
    }

    public function show(Request $request)
    {
        return response()->json($map, 200);
    }

    public function getRow()
    {
        $rowArray = range(1, env('row'));
        return $rowArray;
    }

    public function getColumn()
    {
        $rowArray = range(1, env('column'));
        return $rowArray;
    }

    public function update(Request $request)
    {
        $specification          = Specification::findorfail($request->item_id);
        $specification->spec_id = $request->nome;
        $specification->type    = $request->type;
        $specification->save();
        return redirect()->back();
    }
}
