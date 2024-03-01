<?php

namespace App\Http\Controllers;

use App\Models\venta;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VentaController extends Controller
{
    public function index()
    {
        $venta = venta::all();
        return response()->json($venta);
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
                'numVenta' => 'required|string|max:255',
                'cliente_id' => 'required|exists:cliente,id',
                'producto_id' => 'required|exists:producto,id',
                'cantidad' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $categoria = new venta();
            $categoria->numVenta = $request->numVenta;
            $categoria->cliente_id = $request->cliente_id;
            $categoria->producto_id = $request->producto_id;
            $categoria->cantidad = $request->cantidad;
            $categoria->save();

            return response()->json(['message' => 'Venta creada correctamente'], 201);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(venta $venta)
    {
        $venta = venta::find($venta);
        return response()->json($venta);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, venta $compraProducto)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(venta $venta)
    {
        $venta->delete();

        return response()->json(['message' => 'venta eliminada '], 201);
    }
}
