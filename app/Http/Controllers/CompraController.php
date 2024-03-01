<?php

namespace App\Http\Controllers;

use App\Models\compra;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompraController extends Controller
{
    public function index()
    {
        $compra = compra::all();
        return response()->json($compra);
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
                'numCompra' => 'required|string|max:255',
                'cliente_id' => 'required|exists:cliente,id',
                'producto_id' => 'required|exists:producto,id',
                'cantidad' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $categoria = new compra();
            $categoria->numCompra = $request->numCompra;
            $categoria->cliente_id = $request->cliente_id;
            $categoria->producto_id = $request->producto_id;
            $categoria->cantidad = $request->cantidad;
            $categoria->save();

            return response()->json(['message' => 'Categoría creada correctamente'], 201);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(compra $compraProducto)
    {
        $compraProducto = compra::find($compraProducto);
        return response()->json($compraProducto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(compra $compraProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, compra $compraProducto)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(compra $compraProducto)
    {
        $compraProducto->delete();

        return response()->json(['message' => 'factura eliminada '], 201);
    }
}
