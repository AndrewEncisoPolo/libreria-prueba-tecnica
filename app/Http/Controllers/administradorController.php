<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class administradorController extends Controller
{
    public function initLibro(){
        $data_autor = DB::select('CALL get_autor()');
        $data_editorial = DB::select('CALL get_editorial()');

        return view('libros/libro')->with('data_autor', $data_autor)->with('data_editorial', $data_editorial);
    }

    public function initAutor(){
        return view('autores/autor');
    }

    public function initEditorial(){
        return view('editorial/editorial');
    }
    
    // ----------------------------------------------------------- //

    public function obtenerLibros(){
        $data = DB::select('CALL get_libros()');
        echo json_encode($data);
    }

    public function obtenerAutores(){
        $data = DB::select('CALL get_autor()');
        echo json_encode($data);
    }

    public function obtenerEditoriales(){
        $data = DB::select('CALL get_editorial()');
        echo json_encode($data);
    }

    // ----------------------------------------------------------- //

    public function registrarLibro(Request $request){
        $output = "";
        $data = DB::select('CALL insert_libro(?,?,?,?,?,?)',[$request->get('ISBN'),$request->get('Autor'),$request->get('Editorial'),$request->get('TituloLibro'),$request->get('Sinopsis'),$request->get('NroPaginas')]);
        
        $salida = "";$mensaje = "";
        foreach ($data as $key) {$salida = $key->Salida;$mensaje = $key->Mensaje;}
        $output = $salida;

        echo $output;
    }

    public function registrarEditorial(Request $request){
        $output = "";
        $data = DB::select('CALL insert_editorial(?,?)',[$request->get('Editorial'),$request->get('Sede')]);
        
        $salida = "";$mensaje = "";
        foreach ($data as $key) {$salida = $key->Salida;$mensaje = $key->Mensaje;}
        $output = $salida;

        echo $output;
    }

    public function registrarAutor(Request $request){
        $output = "";
        $data = DB::select('CALL insert_autor(?,?)',[$request->get('Nombre'),$request->get('Apellido')]);
        
        $salida = "";$mensaje = "";
        foreach ($data as $key) {$salida = $key->Salida;$mensaje = $key->Mensaje;}
        $output = $salida;

        echo $output;
    }
    
}
