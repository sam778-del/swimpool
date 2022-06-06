<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
use App\Models\Specification;
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
            'row' => $this->getRow(),
            'column' => $this->getColumn()
        ];
        return view('map.index', compact('data'));
    }

    public function show(Request $request)
    {
        return response()->json($map, 200);
    }

    public function getRow()
    {
        return Specification::orderBy('id', 'ASC')->where('utility', 'row')->limit(19)->get();
    }

    public function getColumn()
    {
        return Specification::orderBy('id', 'ASC')->where('utility', 'column')->limit(10)->get();
    }

    public function update(Request $request)
    {
        $specification          = Specification::findorfail($request->item_id);
        $specification->spec_id = $request->nome;
        $specification->type    = $request->type;
        $specification->save();

        $column = Specification::findorfail($request->column_id);
        $column->spec_id = $request->nome;
        $column->type = $request->type;
        $column->save();
        return redirect()->back();
    }
}
