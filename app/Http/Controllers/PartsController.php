<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parts;
use App\Models\PartsType;
use App\Models\Equipament;
use App\Models\IslandStore;
use App\Models\PMStore;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;


class PartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parts = Parts::all();

        $pmStore = PMStore::all();
        $islandStore = IslandStore::all();

        return Inertia::render('Maintenance/Parts/ListParts',
        [
            'parts' => $parts,
            'pmStore' => $pmStore,
            'islandStore' => $islandStore,
        ]);
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
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $parts = $request->validate([
                'description' => ['required'],
                'amount' => ['required'],
                'equipament_id' => ['required'],
            ]);


            $part = Parts::create([
                'description' => $parts['description'],
                'amount' => $parts['amount'],
                'equipament_id' => $parts['equipament_id'],
                'parts_type_id' => 1,

            ]);

            $pmParts = PMStore::where('parts_id', $part->id)->first();

            if(isset($pmParts->amount)){
                $over = $pmParts->amount+$part->amount;

                PMStore::findOrFail($pmParts->id)->update([
                        'amount' => $over,

                ]);

            }else{
                $over = $part->amount;

                PMStore::create([
                    'amount' => $over,
                    'parts_id' => $part->id,
                ]);

            }

            DB::commit();

            return redirect('/parts')->with(['message' => 'Novo produto criado com sucesso!']);

        } catch (\Exception $e) {
            DB::rollback();

            return redirect('/parts')->with(['error' => 'Não foi possível registrar produto, tente novamente mais tarde.']);
        }
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
