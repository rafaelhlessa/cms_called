<?php

namespace App\Http\Controllers;

use App\Models\PMStore;
use App\Http\Requests\StorePMStoreRequest;
use App\Http\Requests\UpdatePMStoreRequest;
use App\Models\Parts;
use App\Models\PartsType;
use App\Models\Equipament;
use Inertia\Inertia;

class PMStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partsType = PartsType::all();
        $equipaments = Equipament::all();

        return Inertia::render('Maintenance/Parts/CreateParts',[
            'partsType' => $partsType,
            'equipaments' => $equipaments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePMStoreRequest $request)
    {
        $parts = $request->validate([
            'description' => ['required'],
            'amount' => ['required'],
            'equipament_id' => ['required'],
            'parts_type_id' => ['required'],
        ]);
    //    dd($parts);

        Parts::create([
            'description' => $parts['description'],
            'amount' => $parts['amount'],
            'equipament_id' => $parts['equipament_id'],
            'parts_type_id' => $parts['parts_type_id'],

        ]);
        return redirect('/parts')->with(['message' => 'Novo produto criado com sucesso!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(PMStore $pMStore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PMStore $pMStore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePMStoreRequest $request, PMStore $pMStore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PMStore $pMStore)
    {
        //
    }
}
