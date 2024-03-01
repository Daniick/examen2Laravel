<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function index()
    {
        $cliente = cliente::all();
        return response()->json($cliente);
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
                'apellido' => 'required|string|max:255',
                'edad' => 'required|integer|max:255',
                'identificacion' => 'required|string|max:255',
                'telefono' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $cliente = new cliente();
            $cliente->nombre = $request->nombre;
            $cliente->apellido = $request->apellido;
            $cliente->edad = $request->edad;
            $cliente->identificacion = $request->identificacion;
            $cliente->telefono = $request->telefono;
            $cliente->save();

            return response()->json(['message' => 'Cliente creado correctamente'], 201);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(cliente $cliente)
    {
        $cliente = cliente::find($cliente);
        return response()->json($cliente);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cliente $categoria)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cliente $categoria)
    {
        $categoria->delete();

        return response()->json(['message' => 'Cliente eliminada '], 201);
    }
}
