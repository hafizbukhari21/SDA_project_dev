<?php 

namespace App\Utils;

use Illuminate\Http\Request;

class DatatableFormater {
    static function format(Request $request, $query,$columns,$load=[]){
        $sortColumnIndex = $request->input('order.0.column'); // Get the index of the sorting column
        $sortDirection = $request->input('order.0.dir'); // Get the sorting direction (asc or desc)
        $sortColumn = $columns[$sortColumnIndex]; // Get the actual column name based on the index

        if (in_array($sortColumn, $columns) && in_array($sortDirection, ['asc', 'desc'])) {
            $query->orderBy($sortColumn, $sortDirection);
        }

        $totalData = $query->count();
        $start = $request->input('start');
        $length = $request->input('length');
        $query->skip($start)->take($length);
        $data = $query->get()->load($load);
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $data
        ]);
    }
}