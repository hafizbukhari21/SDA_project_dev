<?php 

namespace App\Utils;

use Illuminate\Http\Request;

class DatatableFormater {
    static function format(Request $request, $query){
        $totalData = $query->count();
        $start = $request->input('start');
        $length = $request->input('length');
        $query->skip($start)->take($length);
        $data = $query->get();
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $data
        ]);
    }
}