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
                // 'amount' => ['required'],
                'equipament_id' => ['required'],
            ]);

            $part = Parts::create([
                'description' => $parts['description'],
                'amount' => $request['amount'],
                'equipament_id' => $parts['equipament_id'],
                'parts_type_id' => 1,

            ]);

            $pmParts = PMStore::where('parts_id', $part->id)->first();

            if($pmParts != null){
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
        $parts = Parts::findOrFail($id);

        return Inertia::render('Maintenance/Parts/CreatePartsPM', ['parts' => $parts]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $parts = Parts::findOrFail($id);

            $pmParts = PMStore::where('parts_id', $id)->first();

            if($pmParts != null){
                if(isset($pmParts->amount)){
                    $over = $pmParts->amount+$request->amount;
                    $overp = $parts->amount+$request->amount;

                    PMStore::findOrFail($pmParts->id)->update([
                            'amount' => $over,
                    ]);

                    Parts::findOrFail($id)->update([
                        'amount' => $overp,
                    ]);

                }
            } else {
                $over = $request->amount;

                    Parts::findOrFail($id)->update([
                        'amount' => $over,
                    ]);

                    PMStore::create([
                        'amount' => $over,
                        'parts_id' => $parts->id,
                    ]);
            }


            DB::commit();

            return redirect('/parts')->with(['message' => 'Novo produto criado com sucesso!']);

        } catch (\Exception $e) {
            DB::rollback();

            return $e;
            return redirect('/parts')->with(['error' => 'Não foi possível registrar produto, tente novamente mais tarde.']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
