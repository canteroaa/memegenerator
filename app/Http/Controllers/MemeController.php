<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemeController extends Controller
{
    //Funcion para mostrar todas las imagenes
    public function index()
    {
        // Obtiene todas las imagenes de la base de datos
        $images = DB::table('memes')->get();

        foreach ($images as $image) { //recorre cada imagen
            $image->image = 'data:image/png;base64,' . base64_encode(stream_get_contents($image->image)); //convierte la imagen a base64
        }


        return Inertia::render('Index', [

            'images' => $images,

        ]);
    }

    //Función que devuelve la vista de crear meme
    public function create()
    {

        return Inertia::render('Create', []);
    }

    //Función que guarda el meme en la base de datos
    public function save(Request $request)
    {

        $imagen = $request->imagen; // Obtiene la imagen en base64

        $cadenaBase64 = substr($imagen, strpos($imagen, ',') + 1); // Extrae la parte de la cadena Base64, después de la coma

        $query = "INSERT INTO memes (image) VALUES (decode('$cadenaBase64', 'base64'))"; // query que inserta la imagen decodeada

        DB::statement($query); // Ejecuta la consulta "query"

        return redirect()->route('meme.index'); // redirecciona a la vista de index
    }


    //Función que elimina el meme
    public function destroy(Meme $meme)
    {
        $meme->delete();
        return redirect()->back();
    }


    //subir una imagen de la pc a la base de datos
    /*     public function store(Request $request)
    {

        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $imagenRuta = $request->file('img')->path(); // Obtiene la ruta temporal de la imagen
            // Realiza la inserción en la tabla 'memes'
            DB::table('memes')->insert([
                'image' => DB::raw("pg_read_binary_file('$imagenRuta')")
            ]);
            return redirect()->route('meme.index');
        }
    } */
}
