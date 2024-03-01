<?php

namespace App\Http\Controllers;

use App\Models\producto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    public function index()
    {
        $producto = producto::all();
        return response()->json($producto);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string|max:255',
                'precio' => 'required|string|max:255',

            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $cliente = new producto();
            $cliente->nombre = $request->nombre;
            $cliente->descripcion = $request->descripcion;
            $cliente->precio = $request->precio;
            $cliente->save();

            return response()->json(['message' => 'producto creado correctamente'], 201);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(producto $cliente)
    {
        $cliente = producto::find($cliente);
        return response()->json($cliente);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(producto $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, producto $categoria)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(producto $producto)
    {
        $producto->delete();

        return response()->json(['message' => 'producto eliminada '], 201);
    }
}
