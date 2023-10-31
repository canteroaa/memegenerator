<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemeController extends Controller
{
    public function index()
    {

        $images = DB::table('memes')->get();

        foreach ($images as $image) {
            $image->image = 'data:image/png;base64,' . base64_encode(stream_get_contents($image->image)); //convierte la imagen a base64
        }


        return Inertia::render('Index', [

            'images' => $images,

        ]);
    }


    public function create()
    {

        return Inertia::render('Create', []);
    }

    public function save(Request $request)
    {

        $imagen = $request->imagen;

        $cadenaBase64 = substr($imagen, strpos($imagen, ',') + 1); // Extrae la parte de la cadena Base64, después de la coma

        $query = "INSERT INTO memes (image) VALUES (decode('$cadenaBase64', 'base64'))"; // query que inserta la imagen decodeada

        DB::statement($query); // Ejecuta la consulta

        return redirect()->route('meme.index');
    }


    
    public function destroy(Meme $meme)
    {
        $meme->delete();
        return redirect()->back();
    }


    //subir imagenes a la base de datos
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
