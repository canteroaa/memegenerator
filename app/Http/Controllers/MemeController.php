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
        /* $meme = Meme::all(); */


        $images = DB::table('memes')->get(); // Supongamos que tienes una tabla llamada 'images'

        // Convertir datos binarios a una URL base64
        foreach ($images as $image) {
            $image->image = 'data:image/jpeg;base64,' . base64_encode(stream_get_contents($image->image));
        }


        return Inertia::render('Index', [


            'images' => $images,

        ]);
    }


    public function create()
    {

        return Inertia::render('Create', []);
    }

    public function store(Request $request)
    {

        /*         $filename = '';

        if($request->hasFile('img')){

            $filename = $request->getSchemeAndHttpHost() . '/build/assets/images' . time() . '.' . $request->img->extension();

            $request->img->move(public_path('/build/assets/images'), $filename);

            Meme::create([
                'image' => $filename,
            ]);

            return redirect()->back();

        }
 */
        /*        $imageData = file_get_contents($request->file('img')->getRealPath());
        $image = new Meme();
        
        $image->image = pg_escape_bytea($imageData);
        $image->save();
        return redirect()->back(); */

 /*        $imagenRuta = 'ruta_de_la_imagen';

        // Realiza la inserción en la tabla 'memes'
        DB::table('memes')->insert([
            'image' => DB::raw("pg_read_binary_file('$imagenRuta')")
        ]); */


        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $imagenRuta = $request->file('img')->path(); // Obtiene la ruta temporal de la imagen
            // Realiza la inserción en la tabla 'memes'
            DB::table('memes')->insert([
                'image' => DB::raw("pg_read_binary_file('$imagenRuta')")
            ]);
            return redirect()->route('meme.index');
        }

    }
}
