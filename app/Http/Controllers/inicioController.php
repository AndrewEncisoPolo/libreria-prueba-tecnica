<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class inicioController extends Controller
{
    public function init(){
        $data = DB::select('CALL get_stock()');
        return view('index')->with('lista_libros', $data);
    }

    public function getDetalleLibro(Request $request){
        $data = DB::select('CALL get_detalle_libro(?)',[$request->get('ISBN')]);
        echo json_encode($data);
    }
}
