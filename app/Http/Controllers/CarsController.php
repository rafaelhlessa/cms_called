<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Drivers;
use App\Models\Parts;
use App\Models\PMStore;
use App\Models\UsedVtr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Cars::all();
        $usedVtr = UsedVtr::with('drivers')->get();

        $used = '';

        foreach ($usedVtr as $u){
            if ($u->kmend == null){
                $used = $u;
            }
        }

        return Inertia::render('P4/ListCars',
            [
                'cars' => $cars,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('P4/CarsCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $cars = $request->validate([
                'plate' => ['required'],
                'brandmodel' => ['required'],
                'km' => ['required'],
                'fuel' => ['required'],
            ]);


            Cars::create([
                'plate' => $cars['plate'],
                'brandmodel' => $cars['brandmodel'],
                'km' => $cars['km'],
                'fuel' => $cars['fuel'],
                'used' => 0,
            ]);


//            $pmParts = PMStore::where('parts_id', $part->id)->first();
//
//            if($pmParts != null){
//                if(isset($pmParts->amount)){
//                    $over = $pmParts->amount+$part->amount;
//
//                    PMStore::findOrFail($pmParts->id)->update([
//                        'amount' => $over,
//
//                    ]);
//
//                }else{
//                    $over = $part->amount;
//
//                    PMStore::create([
//                        'amount' => $over,
//                        'parts_id' => $part->id,
//                    ]);
//
//                }
//            }


            DB::commit();

            return redirect('/cars')->with(['message' => 'Novo produto criado com sucesso!']);

        } catch (\Exception $e) {
            DB::rollback();

            return redirect('/cars')->with(['error' => 'Não foi possível registrar produto, tente novamente mais tarde.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd($id);
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

    public function usedVtr(Request $request, string $id)
    {
        dd($request, $id);
    }

    public function vtrs()
    {
        $cars = Cars::all();
        $usedVtr = UsedVtr::with('drivers')->get();

        $used = '';

        foreach ($usedVtr as $u){
            if ($u->kmend == null){
                $used = $u;
            }
        }

        return Inertia::render('P4/Vtrs',
            [
                'cars' => $cars,
            ]);
    }
}
