<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parts;
use App\Models\PartsType;
use App\Models\Equipament;
use Inertia\Inertia;


class PartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parts = Parts::all();
        // dd($parts);

        return Inertia::render('Maintenance/Parts/ListParts',
        [
            'parts' => $parts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('Maintenance/Parts/CreateParts',[
            'partsType' => PartsType::all()->pluck('description', 'id')->prepend('Escolha fonte da peça', '')->toArray(),
            'equipaments' => Equipament::all()->pluck('description', 'id')->prepend('Escolha o equipamento', '')->toArray(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
